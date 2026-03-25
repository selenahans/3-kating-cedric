<?php

namespace App\Services;

use App\Models\HighlightNote;
use App\Models\ReadingLog;
use App\Models\Task;
use App\Models\TaskCompletion;
use App\Models\User;

class TaskAutoCompletionService
{
    public function syncForUser(int $userId): void
    {
        $this->sync($userId, null, 0);
    }

    public function syncForUserWithPendingRead(int $userId, int $bookId, int $pagesRead): void
    {
        $this->sync($userId, $bookId, $pagesRead);
    }

    private function sync(int $userId, ?int $pendingBookId, int $pendingPages): void
    {
        $tasks = Task::whereNotNull('level_gate')
            ->where('level_gate', '<', 15)
            ->get();

        if ($tasks->isEmpty()) {
            return;
        }

        $completedTaskIds = TaskCompletion::where('user_id', $userId)
            ->pluck('task_id')
            ->all();

        $maxPagesSingleBook = (int) (ReadingLog::query()
            ->fromSub(function ($query) use ($userId) {
                $query->from('reading_logs')
                    ->selectRaw('book_id, SUM(pages_read) as total_pages')
                    ->where('user_id', $userId)
                    ->groupBy('book_id');
            }, 'book_page_totals')
            ->max('total_pages') ?? 0);

        if ($pendingBookId !== null && $pendingPages > 0) {
            $pendingBookCurrentTotal = (int) ReadingLog::where('user_id', $userId)
                ->where('book_id', $pendingBookId)
                ->sum('pages_read');

            $pendingBookProjectedTotal = $pendingBookCurrentTotal + $pendingPages;
            $maxPagesSingleBook = max($maxPagesSingleBook, $pendingBookProjectedTotal);
        }

        $highlightCount = (int) HighlightNote::where('user_id', $userId)->count();
        $notesCount = (int) HighlightNote::where('user_id', $userId)
            ->whereNotNull('note_content')
            ->where('note_content', '!=', '')
            ->count();

        $coinsToAdd = 0;

        foreach ($tasks as $task) {
            if (in_array($task->id, $completedTaskIds, true)) {
                continue;
            }

            $required = max(1, (int) ($task->target_value ?? 1));
            $taskType = (string) ($task->type ?? '');

            $isComplete = match ($taskType) {
                'pages_single' => $maxPagesSingleBook >= $required,
                'highlight' => $highlightCount >= $required,
                'notes' => $notesCount >= $required,
                default => false,
            };

            if (!$isComplete) {
                continue;
            }

            TaskCompletion::create([
                'user_id' => $userId,
                'task_id' => $task->id,
                'completed_at' => now(),
            ]);

            $coinsToAdd += max(0, (int) ($task->coin_reward ?? 0));
            $completedTaskIds[] = $task->id;
        }

        if ($coinsToAdd > 0) {
            $user = User::find($userId);
            if ($user) {
                $user->coins = max(0, (int) ($user->coins ?? 0) + $coinsToAdd);
                $user->save();
            }
        }
    }
}
