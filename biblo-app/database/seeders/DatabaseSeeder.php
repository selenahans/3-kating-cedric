<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\Task;
use App\Models\Item;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\BookSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

       $this->call([CategorySeeder::class,BookSeeder::class]);
       
        // 3. Create Daily Tasks (The Coin Engine)
        Task::create(['title' => 'Daily Reader', 'description' => 'Read at least 3 pages of any book', 'coin_reward' => 50, 'xp_reward' => 20, 'target_value' => 5, 'type' => 'reading/any']);
        Task::create(['title' => 'The Scribbler', 'description' => 'Create 3 highlights or notes', 'coin_reward' => 30, 'xp_reward' => 15 , 'target_value' => 3, 'type'=> 'highlight']);
        Task::create(['title' => 'Book Finisher', 'description' => 'Complete a whole book', 'coin_reward' => 500, 'xp_reward' => 200, 'target_value' => 100, 'type' => 'completion']);

        // 4. Create Store Items (Accessories)
        Item::create(['name' => 'Wizard Hat', 'type' => 'accessory', 'price' => 200, 'image_path' => 'items/wizard_hat.png']);
        Item::create(['name' => 'Cool Shades', 'type' => 'accessory', 'price' => 100, 'image_path' => 'items/shades.png']);
        Item::create(['name' => 'Galaxy Skin', 'type' => 'skin', 'price' => 1000, 'image_path' => 'items/galaxy.png']);
    }
}