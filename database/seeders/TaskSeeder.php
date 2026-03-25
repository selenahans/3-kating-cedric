<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable older gate tasks below level 15 so progression uses lighter page-based milestones.
        Task::whereNotNull('level_gate')
            ->where('level_gate', '<', 15)
            ->update(['level_gate' => null]);

        $tasks = [
            // Easier gate tasks for early progression (< level 15)
            [
                'title' => 'Gate Lv3: Baca 20 Halaman',
                'description' => 'Baca minimal 20 halaman pada salah satu buku.',
                'coin_reward' => 50,
                'xp_reward' => 100,
                'target_value' => 20,
                'type' => 'pages_single',
                'level_gate' => 3,
            ],
            [
                'title' => 'Gate Lv3: Buat 1 Highlight',
                'description' => 'Buat minimal 1 highlight dari buku apa pun.',
                'coin_reward' => 20,
                'xp_reward' => 40,
                'target_value' => 1,
                'type' => 'highlight',
                'level_gate' => 3,
            ],
            [
                'title' => 'Gate Lv3: Buat 1 Notes',
                'description' => 'Buat minimal 1 notes pada highlight.',
                'coin_reward' => 20,
                'xp_reward' => 40,
                'target_value' => 1,
                'type' => 'notes',
                'level_gate' => 3,
            ],
            [
                'title' => 'Gate Lv6: Baca 35 Halaman',
                'description' => 'Baca minimal 35 halaman pada salah satu buku.',
                'coin_reward' => 75,
                'xp_reward' => 150,
                'target_value' => 35,
                'type' => 'pages_single',
                'level_gate' => 6,
            ],
            [
                'title' => 'Gate Lv9: Baca 50 Halaman',
                'description' => 'Baca minimal 50 halaman pada salah satu buku.',
                'coin_reward' => 100,
                'xp_reward' => 200,
                'target_value' => 50,
                'type' => 'pages_single',
                'level_gate' => 9,
            ],
            [
                'title' => 'Gate Lv12: Baca 70 Halaman',
                'description' => 'Baca minimal 70 halaman pada salah satu buku.',
                'coin_reward' => 90,
                'xp_reward' => 180,
                'target_value' => 70,
                'type' => 'pages_single',
                'level_gate' => 12,
            ],
        ];

        foreach ($tasks as $task) {
            Task::updateOrCreate(
                ['title' => $task['title']],
                $task
            );
        }
    }
}
