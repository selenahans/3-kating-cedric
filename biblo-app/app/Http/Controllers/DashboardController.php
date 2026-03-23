<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ReadingLog;
use App\Models\Task;
use App\Models\TaskCompletion;
use App\Models\UserBookProgress;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $books = Book::with('category')->latest()->take(10)->get();

        $completedTaskIdsToday = TaskCompletion::where('user_id', $user->id)
            ->whereDate('completed_at', today())
            ->pluck('task_id');

        $tasks = Task::orderBy('id')->get()->map(function ($task) use ($completedTaskIdsToday) {
            $task->progress_percent = $completedTaskIdsToday->contains($task->id) ? 100 : 0;
            return $task;
        });

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
            'pointsEarned'
        ));
    public function index()
    {
        // 1. Fetch the data you need for the dashboard
        $books = Book::all();
        
        // $userId = auth()->id();
        $userId = 0;
        $tasks = Task::all();
        foreach ($tasks as $task) {

            $task->percentage = 0;

            $typeTask = explode('/', $task->type);
            // 🔥 TASK: READING
            if ($typeTask[0] == 'reading') {

                if($typeTask[1] == 'any'){
                   $pagesToday = ReadingLog::where('user_id', $userId)
                    ->whereDate('created_at', today())
                    ->get()
                    ->groupBy('book_id')
                    ->map(function ($logs) {
                        return $logs->sum('pages_read');
                    })
                    ->max(); 
                   $pagesToday = 2; 
                } else{
                    $pagesToday = ReadingLog::where('user_id', $userId)
                    ->whereDate('created_at', today())
                    ->where('book_id', $typeTask[1])->sum('pages_read');
                }

                $task->percentage = min(
                    ($pagesToday / $task->target_value) * 100,
                    100
                );
            }
        }

        // Maybe the dashboard only needs the 5 most recent books?
        // $recentBooks = Book::latest()->take(5)->get();

        // 2. Pass it to the dashboard view
        return view('dashboard', compact('books', 'tasks'));
    }
}