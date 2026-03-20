<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Fetch the data you need for the dashboard
        $books = Book::all();
        
        // $userId = auth()->id();
        $tasks = Task::all();

        // Maybe the dashboard only needs the 5 most recent books?
        // $recentBooks = Book::latest()->take(5)->get();

        // 2. Pass it to the dashboard view
        return view('dashboard', compact('books', 'tasks'));
    }
}
