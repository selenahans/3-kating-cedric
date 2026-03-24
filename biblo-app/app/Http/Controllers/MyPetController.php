<?php

namespace App\Http\Controllers;

use App\Models\ReadingLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MyPetController extends Controller
{
    private function minimumCoinsForLevel(int $level): int
    {
        $normalizedLevel = max(1, $level);
        // Level 1 gets 100. From level 2 onward, reward is 10 * level.
        return 100 + (int) (10 * ((($normalizedLevel * ($normalizedLevel + 1)) / 2) - 1));
    }

    public function index(Request $request): View
    {
        $user = $request->user();
        $totalPagesRead = (int) ReadingLog::where('user_id', $user->id)->sum('pages_read');

        $xpPerPage = 5;
        $xpPerLevel = 100;

        $totalXp = $totalPagesRead * $xpPerPage;
        $level = intdiv($totalXp, $xpPerLevel) + 1;
        $xpInCurrentLevel = $totalXp % $xpPerLevel;

        // Level 1 tuning requested: +10 knowledge, -3 kenyang, +3 happiness per page.
        $knowledgePercent = min(100, $totalPagesRead * 10);
        $kenyangPercent = max(0, 100 - ($totalPagesRead * 3));
        $happinessPercent = min(100, $totalPagesRead * 3);
        $expPercent = (int) round(($xpInCurrentLevel / $xpPerLevel) * 100);

        $growthTitle = match (true) {
            $level >= 8 => 'Adult',
            $level >= 4 => 'Teen',
            default => 'Baby',
        };

        $minimumCoins = $this->minimumCoinsForLevel($level);
        if ((int) ($user->coins ?? 0) < $minimumCoins) {
            $user->coins = $minimumCoins;
            $user->save();
        }

        $petStats = [
            ['label' => 'Kenyang', 'val' => $kenyangPercent . '%', 'color' => 'bg-biblo-clay', 'width' => $kenyangPercent . '%'],
            ['label' => 'Happiness', 'val' => $happinessPercent . '%', 'color' => 'bg-biblo-sage', 'width' => $happinessPercent . '%'],
            ['label' => 'Knowledge', 'val' => $knowledgePercent . '%', 'color' => 'bg-biblo-moss', 'width' => $knowledgePercent . '%'],
            ['label' => 'Exp', 'val' => $xpInCurrentLevel . '/' . $xpPerLevel, 'color' => 'bg-biblo-charcoal', 'width' => $expPercent . '%'],
        ];

        return view('mypet', [
            'petLevel' => $level,
            'growthTitle' => $growthTitle,
            'petStats' => $petStats,
        ]);
    }
}
