<?php

// database/seeders/BookSeeder.php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Fetch all categories to distribute books
        $categories = Category::all()->pluck('id', 'name');

        $books = [
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'total_pages' => 279,
                'cat' => 'Classics',
                'dir' => 'Pride-and-prejudice',
                'cover' => 'Pride-and-prejudice.jpg'
            ],
            [
                'title' => 'Alice in Wonderland',
                'author' => 'Lewis Carroll',
                'total_pages' => 192,
                'cat' => 'Sci-Fi', // Randomly assigned
                'dir' => 'alice-in-wonderland',
                'cover' => 'alice-in-wonderland.jpg'
            ],
            [
                'title' => 'The Art of War',
                'author' => 'Sun Tzu',
                'total_pages' => 128,
                'cat' => 'Philosophy',
                'dir' => 'art-of-war',
                'cover' => 'art-of-war.png' 
            ],
            [
                'title' => 'Frankenstein',
                'author' => 'Mary Shelley',
                'total_pages' => 280,
                'cat' => 'Horror',
                'dir' => 'frankenstein',
                'cover' => 'frankenstein.jpg'
            ],
            [
                'title' => 'Great Expectations',
                'author' => 'Charles Dickens',
                'total_pages' => 544,
                'cat' => 'Classics',
                'dir' => 'Great-expectations',
                'cover' => 'great-expectations.jpg'
            ],
            [
                'title' => 'Meditations',
                'author' => 'Marcus Aurelius',
                'total_pages' => 254,
                'cat' => 'Philosophy',
                'dir' => 'meditations-of-marcus-aurelius',
                'cover' => 'meditations.png'
            ],
            [
                'title' => 'The Mysterious Affair at Styles',
                'author' => 'Agatha Christie',
                'total_pages' => 296,
                'cat' => 'Mystery',
                'dir' => 'mysterious-affair',
                'cover' => 'mysterious-affair.jpg'
            ],
            [
                'title' => 'Sherlock Holmes',
                'author' => 'Arthur Conan Doyle',
                'total_pages' => 176,
                'cat' => 'Mystery',
                'dir' => 'sherlock',
                'cover' => 'sherlock.jpg'
            ],
            [
                'title' => 'The King in Yellow',
                'author' => 'Robert W. Chambers',
                'total_pages' => 160,
                'cat' => 'Horror',
                'dir' => 'the-king-in-yellow',
                'cover' => 'king-in-yellow.jpg'
            ],
            [
                'title' => 'The War of the Worlds',
                'author' => 'H.G. Wells',
                'total_pages' => 288,
                'cat' => 'Sci-Fi',
                'dir' => 'the-war-of-the-worlds',
                'cover' => 'war-of-worlds.jpg'
            ],
        ];

        foreach ($books as $data) {
            Book::create([
                'category_id' => $categories[$data['cat']],
                'slug'        => Str::slug($data['title']),
                'title'       => $data['title'],
                'author'      => $data['author'],
                'total_pages' => $data['total_pages'],
                'file_path'   => "books/{$data['dir']}/OEBPS/content.opf",
                'cover_image' => "images/cover/{$data['cover']}",
            ]);
        }
    }
}