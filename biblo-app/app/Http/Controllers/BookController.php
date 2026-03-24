<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\UserBookProgress;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BookController extends Controller
{

    public function show(Book $book)
    {
        $book->load('category');

        $progress = (object) [
            'current_location' => '',
            'progress_percentage' => 0
        ];

        $recommendations = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->inRandomOrder()
            ->take(5)
            ->get();

        if ($recommendations->count() < 5) {
            $recommendations = Book::where('id', '!=', $book->id)
                ->inRandomOrder()
                ->take(5)
                ->get();
        }

        $chapters = [];

        $opfPath = storage_path('app/public/' . $book->file_path);

        if (File::exists($opfPath)) {
            $ncxPath = dirname($opfPath, 1) . '/toc.ncx';

            if (File::exists($ncxPath)) {
                $xml = simplexml_load_file($ncxPath);
                $xml->registerXPathNamespace('n', 'http://www.daisy.org/z3986/2005/ncx/');
                $navPoints = $xml->xpath('//n:navPoint/n:navLabel/n:text');

                foreach ($navPoints as $point) {
                    $chapters[] = (string) $point;
                }
            }
        }

        $previewChapters = array_slice($chapters, 0, 5);

        $isFavorite = false;
        if (Auth::check()) {
            $progress = UserBookProgress::where('user_id', Auth::id())
                ->where('book_id', $book->id)
                ->first();

            $isFavorite = $progress ? $progress->is_favorite : false;
        }

        return view('book.detail', compact('book', 'progress', 'recommendations', 'previewChapters', 'isFavorite'));
    }

    public function read(Request $request, Book $book)
    {
        $progress = UserBookProgress::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'book_id' => $book->id,
            ],
            [
                'current_location' => null, // CFI, not page
                'progress_percentage' => 0,
                'is_favorite' => false,
                'status' => 'reading',
            ]
        );

        $storagePath = storage_path('app/public/' . $book->file_path);

        $bookSourceUrl = File::exists($storagePath)
            ? route('book.stream', $book)
            : null;

        return view('book.read', compact('book', 'progress', 'bookSourceUrl'));
    }



    public function stream(Book $book): BinaryFileResponse|Response
    {
        $path = storage_path('app/public/' . $book->file_path);

        if (!File::exists($path)) {
            return response('Book file not found', 404);
        }

        $extension = strtolower((string) pathinfo($path, PATHINFO_EXTENSION));
        $contentType = $extension === 'epub' ? 'application/epub+zip' : 'application/xml';

        return response()->file($path, [
            'Content-Type' => $contentType,
            'Access-Control-Allow-Origin' => '*',
        ]);
    }

    public function updateProgress(Request $request, Book $book): JsonResponse
    {
        $validated = $request->validate([
            'current_location' => ['required', 'string', 'max:1000'], // CFI
            'progress_percentage' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        $progress = UserBookProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'book_id' => $book->id,
            ],
            [
                'current_location' => $validated['current_location'],
                'progress_percentage' => $validated['progress_percentage'],
                'status' => $validated['progress_percentage'] >= 100 ? 'completed' : 'reading',
            ]
        );

        return response()->json([
            'success' => true,
            'progress_percentage' => $progress->progress_percentage,
            'status' => $progress->status,
        ]);
    }


    public function toggleLibrary($id)
    {
        $progress = UserBookProgress::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'book_id' => $id
            ],
            [
                'is_favorite' => false,
                'current_location' => '',
                'progress_percentage' => 0
            ]
        );

        $progress->is_favorite = !$progress->is_favorite;
        $progress->save();

        return back();
    }
}