<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskCompletion;
use App\Models\HighlightNote;
use App\Models\ReadingLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getGateTasks(Request $request, int $levelGate): JsonResponse
    {
        $user = $request->user();
        
        $tasks = Task::where('level_gate', $levelGate)->get();

        if ($tasks->isEmpty()) {
            return response()->json([
                'success' => true,
                'tasks' => [],
                'all_completed' => true,
            ]);
        }

        $tasksWithStatus = $tasks->map(function ($task) use ($user) {
            $completed = TaskCompletion::where('user_id', $user->id)
                ->where('task_id', $task->id)
                ->exists();

            return [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'coin_reward' => $task->coin_reward,
                'xp_reward' => $task->xp_reward,
                'completed' => $completed,
            ];
        });

        $completedCount = $tasksWithStatus->where('completed', true)->count();

        return response()->json([
            'success' => true,
            'level_gate' => $levelGate,
            'tasks' => $tasksWithStatus,
            'completed_count' => $completedCount,
            'total_count' => $tasksWithStatus->count(),
            'all_completed' => $completedCount === $tasksWithStatus->count(),
        ]);
    }

    public function completeTask(Request $request): JsonResponse
    {
        $user = $request->user();
        $validated = $request->validate([
            'task_id' => ['required', 'exists:tasks,id'],
        ]);

        $taskId = $validated['task_id'];
        $task = Task::findOrFail($taskId);

        // Check if already completed
        $existing = TaskCompletion::where('user_id', $user->id)
            ->where('task_id', $taskId)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => true,
                'message' => 'Task sudah diselesaikan sebelumnya.',
                'task_id' => $taskId,
                'already_completed' => true,
            ]);
        }

        // For early gates (<15), validate completion based on task type.
        if ((int) ($task->level_gate ?? 0) > 0 && (int) $task->level_gate < 15) {
            $required = max(1, (int) ($task->target_value ?? 1));
            $taskType = (string) ($task->type ?? '');

            if ($taskType === 'pages_single') {
                $maxPagesSingleBook = (int) (ReadingLog::query()
                    ->fromSub(function ($query) use ($user) {
                        $query->from('reading_logs')
                            ->selectRaw('book_id, SUM(pages_read) as total_pages')
                            ->where('user_id', $user->id)
                            ->groupBy('book_id');
                    }, 'book_page_totals')
                    ->max('total_pages') ?? 0);

                if ($maxPagesSingleBook < $required) {
                    return response()->json([
                        'success' => false,
                        'message' => "Belum bisa complete. Baca minimal {$required} halaman di satu buku (progress: {$maxPagesSingleBook}/{$required}).",
                        'task_id' => $taskId,
                    ], 422);
                }
            } elseif ($taskType === 'highlight') {
                $highlightCount = (int) HighlightNote::where('user_id', $user->id)->count();
                if ($highlightCount < $required) {
                    return response()->json([
                        'success' => false,
                        'message' => "Belum bisa complete. Buat minimal {$required} highlight (progress: {$highlightCount}/{$required}).",
                        'task_id' => $taskId,
                    ], 422);
                }
            } elseif ($taskType === 'notes') {
                $notesCount = (int) HighlightNote::where('user_id', $user->id)
                    ->whereNotNull('note_content')
                    ->where('note_content', '!=', '')
                    ->count();

                if ($notesCount < $required) {
                    return response()->json([
                        'success' => false,
                        'message' => "Belum bisa complete. Buat minimal {$required} notes (progress: {$notesCount}/{$required}).",
                        'task_id' => $taskId,
                    ], 422);
                }
            }
        }

        // Mark as completed
        TaskCompletion::create([
            'user_id' => $user->id,
            'task_id' => $taskId,
            'completed_at' => now(),
        ]);

        // Optionally award coins/xp to user
        if ($task->coin_reward > 0) {
            $user->coins = max(0, (int) $user->coins + $task->coin_reward);
            $user->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Task berhasil diselesaikan!',
            'task_id' => $taskId,
            'coin_reward' => $task->coin_reward,
            'xp_reward' => $task->xp_reward,
            'user_coins' => (int) $user->coins,
        ]);
    }
}
