<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReadingLog;
use App\Models\User;
use App\Models\UserPet;
use App\Models\Task;
use App\Models\TaskCompletion;
use App\Services\TaskAutoCompletionService;
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

    private function checkLevelGate(int $newLevel, int $userId): array
    {
        // Validate all gate levels up to projected level to prevent bypassing old gates.
        $gateLevels = Task::whereNotNull('level_gate')
            ->where('level_gate', '<=', $newLevel)
            ->orderBy('level_gate')
            ->pluck('level_gate')
            ->unique()
            ->values();

        foreach ($gateLevels as $gateLevel) {
            $requiredTasks = Task::where('level_gate', (int) $gateLevel)->get();

            if ($requiredTasks->isEmpty()) {
                continue;
            }

            $completedCount = 0;
            $incompleteTasks = [];

            foreach ($requiredTasks as $task) {
                $completed = TaskCompletion::where('user_id', $userId)
                    ->where('task_id', $task->id)
                    ->exists();

                if ($completed) {
                    $completedCount++;
                } else {
                    $incompleteTasks[] = [
                        'id' => $task->id,
                        'title' => $task->title,
                        'description' => $task->description,
                    ];
                }
            }

            if ($completedCount !== $requiredTasks->count()) {
                return [
                    'allowed' => false,
                    'level_gate' => (int) $gateLevel,
                    'completed' => $completedCount,
                    'total' => $requiredTasks->count(),
                    'incomplete_tasks' => $incompleteTasks,
                ];
            }
        }

        return ['allowed' => true];
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'pages_read' => 'required|integer|min:1',
        ]);

        $userId = Auth::id();
        $pagesRead = (int) $request->pages_read;

        $user = User::findOrFail($userId);
        $pet = UserPet::firstOrCreate(
            ['user_id' => $userId],
            [
                'nickname' => $user->name,
                'type' => 'owl',
                'xp' => 0,
                'stage' => 'baby',
                'health' => 100,
                'happiness' => 100,
            ]
        );

        if ((int) $pet->health < 30) {
            return response()->json([
                'success' => false,
                'message' => 'Pet kamu lapar. Kasih makan dulu sebelum lanjut baca.',
                'hungry_blocked' => true,
                'health' => (int) $pet->health,
            ], 422);
        }

        $totalPagesBefore = (int) ReadingLog::where('user_id', $userId)->sum('pages_read');
        $totalPagesAfter = $totalPagesBefore + $pagesRead;

        $xpPerPage = 5;
        $xpPerLevel = 100;

        $oldLevel = intdiv($totalPagesBefore * $xpPerPage, $xpPerLevel) + 1;
        $newLevel = intdiv($totalPagesAfter * $xpPerPage, $xpPerLevel) + 1;
        $leveledUp = $newLevel > $oldLevel;

        // Auto-complete early gate tasks (pages/highlight/notes) when requirements are met.
        app(TaskAutoCompletionService::class)
            ->syncForUserWithPendingRead($userId, (int) $request->book_id, $pagesRead);

        // Check all required level gates up to projected level before persisting log.
        $gateCheck = $this->checkLevelGate($newLevel, $userId);
        if (!$gateCheck['allowed']) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus menyelesaikan semua tugas sebelum naik ke level ' . $gateCheck['level_gate'],
                'level_blocked' => true,
                'level_gate_info' => $gateCheck,
                'old_level' => $oldLevel,
                'new_level' => $newLevel,
            ], 422);
        }

        ReadingLog::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'pages_read' => $pagesRead,
        ]);

        $pet->health = max(0, (int) $pet->health - ($pagesRead * 3));
        $pet->save();

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