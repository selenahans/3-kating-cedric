<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReadingLog;
use Illuminate\Support\Facades\Auth;

class ReadingLogController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'pages_read' => 'required|integer|min:1',
        ]);

        ReadingLog::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'pages_read' => $request->pages_read,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reading log saved'
        ]);
    }
}