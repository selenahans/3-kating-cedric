<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReadingLog;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class ReadingLogController extends Controller
{
    private function minimumCoinsForLevel(int $level): int
    {
        $normalizedLevel = max(1, $level);
        // Level 1 gets 100. From level 2 onward, reward is 10 * level.
        return 100 + (int) (10 * ((($normalizedLevel * ($normalizedLevel + 1)) / 2) - 1));
    }

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

        $user = User::findOrFail($userId);
        $coinsBefore = 0;
        $coinsAwarded = 0;
        if (Schema::hasColumn('users', 'coins')) {
            $coinsBefore = (int) ($user->coins ?? 0);
            $minimumCoins = $this->minimumCoinsForLevel($newLevel);

            if ($coinsBefore < $minimumCoins) {
                $coinsAwarded = $minimumCoins - $coinsBefore;
                $user->coins = $minimumCoins;
                $user->save();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Reading log saved',
            'leveled_up' => $leveledUp,
            'old_level' => $oldLevel,
            'new_level' => $newLevel,
            'pages_read' => $pagesRead,
            'coins_awarded' => $coinsAwarded,
            'coins_total' => Schema::hasColumn('users', 'coins') ? (int) ($user->coins ?? 0) : 0,
        ]);
    }
}