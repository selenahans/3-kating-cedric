<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Task;
use App\Models\TaskCompletion;
use App\Models\UserBookProgress;
use App\Models\ReadingLog;
use App\Models\ReadingGoal;
use App\Models\HighlightNote;
use App\Models\UserInventory;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\View\View;


class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $books = Book::with('category')->latest()->take(10)->get();

        $userId = Auth::id();

        $petTotalPagesRead = (int) ReadingLog::where('user_id', $userId)->sum('pages_read');
        $petLevel = intdiv($petTotalPagesRead * 5, 100) + 1;

        $availableLevelGates = Task::query()
            ->whereNotNull('level_gate')
            ->orderBy('level_gate')
            ->pluck('level_gate')
            ->unique()
            ->values();

        $activeLevelGate = $availableLevelGates
            ->first(fn ($gate) => (int) $gate > $petLevel);

        if (is_null($activeLevelGate)) {
            $activeLevelGate = $availableLevelGates->last() ?? 3;
        }

        $tasks = Task::where('level_gate', $activeLevelGate)
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

        // Use persisted onboarding target (reading_goals) as the source of truth.
        $readingGoal = ReadingGoal::where('user_id', $userId)->first();
        $goalPages = $readingGoal?->daily_target_pages ?? 15;

        $estimatedCurrentPages = 0;
        if ($currentProgress && $currentBook && $currentBook->total_pages > 0) {
            $estimatedCurrentPages = (int) round(($currentProgress->progress_percentage / 100) * $currentBook->total_pages);
        }

        $todayPagesRead = (int) ReadingLog::where('user_id', $userId)
            ->whereDate('created_at', Carbon::today())
            ->sum('pages_read');

        $goalRemainingPages = max(0, $goalPages - $todayPagesRead);

        $goalProgressPercent = $goalPages > 0
            ? min(100, (int) round(($todayPagesRead / $goalPages) * 100))
            : 0;

        $dailyGoalMessage = 'Yuk mulai baca hari ini untuk memberi makan ' . ($user->pet?->nickname ?? 'Barnaby') . '.';
        if ($todayPagesRead > 0 && $todayPagesRead < $goalPages) {
            $dailyGoalMessage = number_format($goalRemainingPages, 0, ',', '.')
                . ' lembar lagi untuk memberi makan '
                . ($user->pet?->nickname ?? 'Barnaby')
                . '!';
        }

        if ($todayPagesRead >= $goalPages) {
            $dailyGoalMessage = 'Selamat! Target harian tercapai hari ini, ' . ($user->pet?->nickname ?? 'Barnaby') . ' senang sekali!';
        }

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

        $now = Carbon::now();
        $monthStart = $now->copy()->startOfMonth();
        $monthEnd = $now->copy()->endOfMonth();

        $recapMonthLabel = ucfirst($now->copy()->locale('id')->translatedFormat('F'));

        $monthlyBooksCompleted = UserBookProgress::where('user_id', $userId)
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$monthStart, $monthEnd])
            ->count();

        $monthlyPagesRead = (int) ReadingLog::where('user_id', $userId)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->sum('pages_read');

        $monthlyPointsEarned = TaskCompletion::where('user_id', $userId)
            ->whereBetween('completed_at', [$monthStart->toDateString(), $monthEnd->toDateString()])
            ->whereHas('task')
            ->with('task')
            ->get()
            ->sum(function ($completion) {
                return (int) (($completion->task->coin_reward ?? 0) + ($completion->task->xp_reward ?? 0));
            });

        $daysInMonth = (int) $now->daysInMonth;
        $segmentSize = (int) ceil($daysInMonth / 4);
        $monthlyPageSegments = [];

        for ($segmentIndex = 0; $segmentIndex < 4; $segmentIndex++) {
            $startDay = ($segmentIndex * $segmentSize) + 1;
            $endDay = min(($segmentIndex + 1) * $segmentSize, $daysInMonth);

            if ($startDay > $daysInMonth) {
                $monthlyPageSegments[] = 0;
                continue;
            }

            $segmentStart = $monthStart->copy()->day($startDay)->startOfDay();
            $segmentEnd = $monthStart->copy()->day($endDay)->endOfDay();

            $monthlyPageSegments[] = (int) ReadingLog::where('user_id', $userId)
                ->whereBetween('created_at', [$segmentStart, $segmentEnd])
                ->sum('pages_read');
        }

        $maxSegmentPages = max(1, max($monthlyPageSegments));
        $monthlyPageSegmentHeights = collect($monthlyPageSegments)
            ->map(fn ($pages) => max(18, (int) round(($pages / $maxSegmentPages) * 90)))
            ->all();

        $dayStreak = 0;
        $readDates = ReadingLog::where('user_id', $userId)
            ->selectRaw('DATE(created_at) as read_date')
            ->distinct()
            ->orderByDesc('read_date')
            ->pluck('read_date')
            ->map(fn ($date) => Carbon::parse($date)->toDateString())
            ->all();

        if (!empty($readDates)) {
            $expectedDate = Carbon::today();

            if ($readDates[0] !== $expectedDate->toDateString() && $readDates[0] === $expectedDate->copy()->subDay()->toDateString()) {
                $expectedDate = $expectedDate->subDay();
            }

            foreach ($readDates as $readDate) {
                if ($readDate !== $expectedDate->toDateString()) {
                    break;
                }

                $dayStreak++;
                $expectedDate->subDay();
            }
        }

        // Resolve equipped skin image
        $petImage = asset('images/boo-pet.webp');
        if (Schema::hasTable('items') && Schema::hasTable('user_inventory') && Schema::hasColumn('user_inventory', 'is_equipped')) {
            $equippedSkin = UserInventory::with('item')
                ->where('user_id', $user->id)
                ->where('is_equipped', true)
                ->whereHas('item', function ($query) {
                    $query->where('type', 'skin');
                })
                ->first();

            $skinImagePath = $equippedSkin?->item?->image_path;
            if (!empty($skinImagePath) && is_file(public_path($skinImagePath))) {
                $petImage = asset($skinImagePath);
            }
        }

        return view('dashboard', compact(
            'books',
            'tasks',
            'currentBook',
            'currentProgress',
            'readingGoal',
            'goalPages',
            'estimatedCurrentPages',
            'todayPagesRead',
            'goalRemainingPages',
            'goalProgressPercent',
            'dailyGoalMessage',
            'booksCompleted',
            'totalPagesRead',
            'pointsEarned',
            'activeLevelGate',
            'recapMonthLabel',
            'monthlyBooksCompleted',
            'monthlyPagesRead',
            'monthlyPointsEarned',
            'monthlyPageSegmentHeights',
            'dayStreak',
            'petLevel',
            'petImage'
        ));
    }
}