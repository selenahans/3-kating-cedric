<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\Task;
use App\Models\Item;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Categories
        $categories = [
            'Classic' => 'classic',
            'Sci-Fi' => 'sci-fi',
            'Fantasy' => 'fantasy',
            'Mystery' => 'mystery',
            'Self-Help' => 'self-help'
        ];

        foreach ($categories as $name => $slug) {
            Category::create(['name' => $name, 'slug' => $slug]);
        }

        // 2. Create 10 Books (Project Gutenberg)
        $books = [
            ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen', 'cat' => 'classic', 'id' => 1342],
            ['title' => 'Great Expectations', 'author' => 'Charles Dickens', 'cat' => 'classic', 'id' => 1400],
            ['title' => 'The War of the Worlds', 'author' => 'H.G. Wells', 'cat' => 'sci-fi', 'id' => 36],
            ['title' => 'Frankenstein', 'author' => 'Mary Shelley', 'cat' => 'sci-fi', 'id' => 84],
            ['title' => "Alice's Adventures in Wonderland", 'author' => 'Lewis Carroll', 'cat' => 'fantasy', 'id' => 11],
            ['title' => 'The King in Yellow', 'author' => 'Robert W. Chambers', 'cat' => 'fantasy', 'id' => 8492],
            ['title' => 'The Adventures of Sherlock Holmes', 'author' => 'Arthur Conan Doyle', 'cat' => 'mystery', 'id' => 1661],
            ['title' => 'The Mysterious Affair at Styles', 'author' => 'Agatha Christie', 'cat' => 'mystery', 'id' => 863],
            ['title' => 'The Meditations of Marcus Aurelius', 'author' => 'Marcus Aurelius', 'cat' => 'self-help', 'id' => 2680],
            ['title' => 'The Art of War', 'author' => 'Sun Tzu', 'cat' => 'self-help', 'id' => 132],
        ];

        foreach ($books as $b) {
            $category = Category::where('slug', $b['cat'])->first();
            Book::create([
                'category_id' => $category->id,
                'title' => $b['title'],
                'author' => $b['author'],
                'file_path' => "books/{$b['id']}.epub",
                'cover_image' => "https://www.gutenberg.org/cache/epub/{$b['id']}/pg{$b['id']}.cover.medium.jpg",
            ]);
        }

        // 3. Create Daily Tasks (The Coin Engine)
        Task::create(['title' => 'Daily Reader', 'description' => 'Read at least 1% of any book', 'coin_reward' => 50, 'xp_reward' => 20]);
        Task::create(['title' => 'The Scribbler', 'description' => 'Create 3 highlights or notes', 'coin_reward' => 30, 'xp_reward' => 15]);
        Task::create(['title' => 'Book Finisher', 'description' => 'Complete a whole book', 'coin_reward' => 500, 'xp_reward' => 200]);

        // 4. Create Store Items (Accessories)
        Item::create(['name' => 'Wizard Hat', 'type' => 'accessory', 'price' => 200, 'image_path' => 'items/wizard_hat.png']);
        Item::create(['name' => 'Cool Shades', 'type' => 'accessory', 'price' => 100, 'image_path' => 'items/shades.png']);
        Item::create(['name' => 'Galaxy Skin', 'type' => 'skin', 'price' => 1000, 'image_path' => 'items/galaxy.png']);
    }
}