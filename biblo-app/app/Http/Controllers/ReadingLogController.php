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

        $userId = Auth::id();
        $pagesRead = (int) $request->pages_read;

        $totalPagesBefore = (int) ReadingLog::where('user_id', $userId)->sum('pages_read');

        ReadingLog::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'pages_read' => $pagesRead,
        ]);

        $totalPagesAfter = $totalPagesBefore + $pagesRead;

        $xpPerPage = 5;
        $xpPerLevel = 100;

        $oldLevel = intdiv($totalPagesBefore * $xpPerPage, $xpPerLevel) + 1;
        $newLevel = intdiv($totalPagesAfter * $xpPerPage, $xpPerLevel) + 1;
        $leveledUp = $newLevel > $oldLevel;

        return response()->json([
            'success' => true,
            'message' => 'Reading log saved',
            'leveled_up' => $leveledUp,
            'old_level' => $oldLevel,
            'new_level' => $newLevel,
            'pages_read' => $pagesRead,
        ]);
    }
}