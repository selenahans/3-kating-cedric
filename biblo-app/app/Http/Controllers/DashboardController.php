<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\ReadingLog;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
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
