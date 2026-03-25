<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Task;
use App\Models\TaskCompletion;
use App\Models\UserBookProgress;
use App\Models\ReadingLog;
use App\Models\HighlightNote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;


class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        
        // $userId = auth()->id();
       
        
        $books = Book::with('category')->latest()->take(10)->get();

        $userId = Auth::id();
        // LOCKED REQUIREMENT: dashboard always shows exactly the 3 tasks for reaching level 3.
        $tasks = Task::where('level_gate', 3)
            ->orderBy('id')
            ->take(3)
            ->get();

        $completedTaskIds = TaskCompletion::where('user_id', $user->id)
            ->pluck('task_id')
            ->all();

        foreach ($tasks as $task) {

            $task->percentage = 0;

            if (in_array($task->id, $completedTaskIds, true)) {
                $task->percentage = 100;
                continue;
            }

            $taskType = (string) ($task->type ?? '');
            $targetValue = max(1, (int) ($task->target_value ?? 1));

            if ($taskType === 'pages_single') {
                $maxPagesSingleBook = (int) (ReadingLog::query()
                    ->fromSub(function ($query) use ($userId) {
                        $query->from('reading_logs')
                            ->selectRaw('book_id, SUM(pages_read) as total_pages')
                            ->where('user_id', $userId)
                            ->groupBy('book_id');
                    }, 'book_page_totals')
                    ->max('total_pages') ?? 0);

                $task->percentage = min((($maxPagesSingleBook / $targetValue) * 100), 100);
            }

            if ($taskType === 'highlight') {
                $count = (int) HighlightNote::where('user_id', $userId)->count();
                $task->percentage = min((($count / $targetValue) * 100), 100);
            }

            if ($taskType === 'notes') {
                $count = (int) HighlightNote::where('user_id', $userId)
                    ->whereNotNull('note_content')
                    ->where('note_content', '!=', '')
                    ->count();

                $task->percentage = min((($count / $targetValue) * 100), 100);
            }
        }

        $currentProgress = UserBookProgress::with('book.category')
            ->where('user_id', $user->id)
            ->where('status', 'reading')
            ->orderByDesc('updated_at')
            ->first();

        $currentBook = $currentProgress?->book;

        $readingGoal = $user->readingGoal;
        $goalPages = $readingGoal?->daily_target_pages ?? 15;

        $estimatedCurrentPages = 0;
        if ($currentProgress && $currentBook && $currentBook->total_pages > 0) {
            $estimatedCurrentPages = (int) round(($currentProgress->progress_percentage / 100) * $currentBook->total_pages);
        }

        $goalProgressPercent = $goalPages > 0
            ? min(100, (int) round(($estimatedCurrentPages / $goalPages) * 100))
            : 0;

        $booksCompleted = UserBookProgress::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        $totalPagesRead = UserBookProgress::with('book')
            ->where('user_id', $user->id)
            ->get()
            ->sum(function ($progress) {
                $totalPages = $progress->book->total_pages ?? 0;
                return (int) round(($progress->progress_percentage / 100) * $totalPages);
            });

        $pointsEarned = TaskCompletion::where('user_id', $user->id)
            ->whereHas('task')
            ->with('task')
            ->get()
            ->sum(function ($completion) {
                return (int) (($completion->task->coin_reward ?? 0) + ($completion->task->xp_reward ?? 0));
            });

        $petTotalPagesRead = (int) ReadingLog::where('user_id', $user->id)->sum('pages_read');
        $petLevel = intdiv($petTotalPagesRead * 5, 100) + 1;

        return view('dashboard', compact(
            'books',
            'tasks',
            'currentBook',
            'currentProgress',
            'readingGoal',
            'goalPages',
            'estimatedCurrentPages',
            'goalProgressPercent',
            'booksCompleted',
            'totalPagesRead',
            'pointsEarned',
            'petLevel'
        ));
    }
}