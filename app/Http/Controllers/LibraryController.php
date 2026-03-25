<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ReadingLog;
use App\Models\TaskCompletion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;

class LibraryController extends Controller
{
    public function index(Request $request): View
    {
        $userId = $request->user()->id;
        $search = trim((string) $request->query('q', ''));
        $status = $request->query('status');
        $sort = $request->query('sort', 'latest');
        $view = $request->query('view', 'books'); // 'books' or 'achievements'

        $query = Book::with([
            'category',
            'progressRecords' => function ($progressQuery) use ($userId) {
                $progressQuery->where('user_id', $userId);
            }
        ])->whereHas('progressRecords', function ($progressQuery) use ($userId, $status) {
            $progressQuery->where('user_id', $userId);

            if (!empty($status)) {
                $progressQuery->where('status', $status);
            }
        });

        if ($search !== '') {
            $query->where(function (Builder $bookQuery) use ($search) {
                $bookQuery->where('title', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function (Builder $categoryQuery) use ($search) {
                        $categoryQuery->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        switch ($sort) {
            case 'title':
                $query->orderBy('title');
                break;
            case 'author':
                $query->orderBy('author');
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $books = $query->get();
        $totalBooks = $books->count();
        $onProgressCount = $books->filter(function (Book $book) {
            $progress = $book->progressRecords->first();
            return $progress && $progress->status === 'reading';
        })->count();

        $completedCount = $books->filter(function (Book $book) {
            $progress = $book->progressRecords->first();
            return $progress && $progress->status === 'completed';
        })->count();

        // Fetch achievements
        $bookMilestones = $this->getBookMilestones($userId);
        $taskAchievements = $this->getTaskAchievements($userId);
        $totalAchievements = count($bookMilestones) + count($taskAchievements);
        $allAchievements = array_merge($bookMilestones, $taskAchievements);

        return view('mylibrary', compact('books', 'totalBooks', 'onProgressCount', 'completedCount', 'search', 'status', 'sort', 'view', 'bookMilestones', 'taskAchievements', 'allAchievements', 'totalAchievements'));
    }

    private function getBookMilestones($userId): array
    {
        $achievements = [];
        
        // Get all books with progress for this user
        $books = Book::with('progressRecords')
            ->whereHas('progressRecords', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();

        foreach ($books as $book) {
            $progress = $book->progressRecords->first();
            if (!$progress) continue;

            $totalPages = $book->total_pages ?? 1;
            $logs = ReadingLog::where('user_id', $userId)
                ->where('book_id', $book->id)
                ->orderBy('created_at')
                ->get();

            $runningPages = 0;
            $milestonesReached = [];

            foreach ($logs as $log) {
                $runningPages += $log->pages_read;
                $percentage = min(100, (int) round(($runningPages / $totalPages) * 100));

                // Check for milestone achievements
                if ($percentage >= 100 && !isset($milestonesReached[100])) {
                    $milestonesReached[100] = $log->created_at;
                } elseif ($percentage >= 60 && !isset($milestonesReached[60])) {
                    $milestonesReached[60] = $log->created_at;
                } elseif ($percentage >= 30 && !isset($milestonesReached[30])) {
                    $milestonesReached[30] = $log->created_at;
                }
            }

            // Convert to achievement objects
            $milestoneLabels = [
                100 => ['title' => 'Penamat Emas', 'icon' => '🥇', 'color' => 'from-amber-50 via-amber-100 to-amber-50'],
                60 => ['title' => 'Pembaca Perak', 'icon' => '🥈', 'color' => 'from-blue-50 via-slate-100 to-blue-50'],
                30 => ['title' => 'Pembaca Perunggu', 'icon' => '🥉', 'color' => 'from-orange-100 via-amber-100 to-orange-100'],
            ];

            foreach ($milestonesReached as $percentage => $unlockedAt) {
                $label = $milestoneLabels[$percentage];
                $achievements[] = (object) [
                    'type' => 'milestone',
                    'title' => $label['title'],
                    'icon' => $label['icon'],
                    'color' => $label['color'],
                    'description' => 'Selesai membaca ' . $book->title,
                    'book_title' => $book->title,
                    'book_id' => $book->id,
                    'percentage' => $percentage,
                    'unlocked_at' => Carbon::parse($unlockedAt)->format('d M Y'),
                    'unlocked_at_full' => $unlockedAt,
                ];
            }
        }

        // Sort by date descending
        usort($achievements, function ($a, $b) {
            return $b->unlocked_at_full <=> $a->unlocked_at_full;
        });

        return $achievements;
    }

    private function getTaskAchievements($userId): array
    {
        $achievements = [];

        // Get all completed tasks
        $completedTasks = TaskCompletion::with('task')
            ->where('user_id', $userId)
            ->whereHas('task')
            ->orderBy('completed_at', 'desc')
            ->get();

        foreach ($completedTasks as $completion) {
            $task = $completion->task;
            
            $taskIcons = [
                'pages_single' => '📖',
                'highlight' => '✨',
                'notes' => '📝',
            ];

            $icon = $taskIcons[$task->type] ?? '🎯';

            $achievements[] = (object) [
                'type' => 'task',
                'title' => $task->title,
                'icon' => $icon,
                'color' => 'from-biblo-sage to-biblo-moss',
                'description' => 'Selesai: ' . $task->description,
                'coin_reward' => $task->coin_reward ?? 0,
                'xp_reward' => $task->xp_reward ?? 0,
                'unlocked_at' => Carbon::parse($completion->completed_at)->format('d M Y'),
                'unlocked_at_full' => $completion->completed_at,
            ];
        }

        return $achievements;
    }
}