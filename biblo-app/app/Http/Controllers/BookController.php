<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\UserBookProgress; 

class BookController extends Controller
{
    public function show($id)
    {
        // 1. Fetch the book and its category
        $book = Book::with('category')->findOrFail($id);

        // 2. Create the dummy progress object (in case you need it for the progress bar UI)
        $progress = (object) [
            'current_location' => '',
            'progress_percentage' => 0
        ];

        // 3. Fetch Recommendations for the bottom of the detail page
        $recommendations = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->inRandomOrder()
            ->take(5)
            ->get();

        // Fallback if there aren't enough books in the same category
        if ($recommendations->count() < 5) {
            $recommendations = Book::where('id', '!=', $book->id)
                ->inRandomOrder()
                ->take(5)
                ->get();
        }

        $chapters = [];

        // Get the absolute path to the .opf file on your hard drive
        // (Assuming you stored the unzipped folders in the public directory)
        $opfPath = storage_path('app/public/' . $book->file_path);

        if (File::exists($opfPath)) {
            // Find the toc.ncx file which is usually in the same OEBPS directory
            $ncxPath = dirname($opfPath, 1) . '/toc.ncx';

            if (File::exists($ncxPath)) {
                // Load the XML securely
                $xml = simplexml_load_file($ncxPath);

                // EPUB NCX files use a specific XML namespace
                $xml->registerXPathNamespace('n', 'http://www.daisy.org/z3986/2005/ncx/');

                // Find all the chapter titles inside the <navLabel><text> tags
                $navPoints = $xml->xpath('//n:navPoint/n:navLabel/n:text');

                foreach ($navPoints as $point) {
                    $chapters[] = (string) $point;
                }
            }
        }

        // Limit to the first 5 chapters so the page doesn't get ridiculously long
        $previewChapters = array_slice($chapters, 0, 5);

        $isFavorite = false;
    if (auth()->check()) {
        $progress = UserBookProgress::where('user_id', auth()->id())
                                ->where('book_id', $id)
                                ->first();
                                
        $isFavorite = $progress ? $progress->is_favorite : false;
    }
        // 4. Return the detail view with all the data
        return view('book.detail', compact('book', 'progress', 'recommendations', 'previewChapters', 'isFavorite'));
    }


    public function toggleLibrary($id)
    {
        // Find or create the progress record for this specific user and book
        $progress = UserBookProgress::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'book_id' => $id
            ],
            [
                // Default values if this is the first time they are interacting with the book
                'is_favorite' => false,
                'current_location' => '',
                'progress_percentage' => 0
            ]
        );

        // Flip the boolean value
        $progress->is_favorite = !$progress->is_favorite;
        $progress->save();

        return back();
    }
}