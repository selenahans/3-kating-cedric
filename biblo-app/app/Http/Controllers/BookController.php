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
    private const DUMMY_TOTAL_PAGES = 10;

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
                'current_location' => '1',
                'progress_percentage' => 0,
                'is_favorite' => false,
                'status' => 'reading',
            ]
        );

        $currentDummyPage = (int) $progress->current_location;
        if ($currentDummyPage < 1 || $currentDummyPage > self::DUMMY_TOTAL_PAGES) {
            $currentDummyPage = 1;
        }

        $requestedPage = $request->integer('page');
        if ($requestedPage >= 1 && $requestedPage <= self::DUMMY_TOTAL_PAGES) {
            $currentDummyPage = $requestedPage;
        }

        // Keep status in sync for older records that might already be at 100%.
        if ($currentDummyPage >= self::DUMMY_TOTAL_PAGES || (float) $progress->progress_percentage >= 100) {
            $progress->current_location = (string) self::DUMMY_TOTAL_PAGES;
            $progress->progress_percentage = 100;
            $progress->status = 'completed';
            $progress->save();
            $currentDummyPage = self::DUMMY_TOTAL_PAGES;
        }

        $storagePath = storage_path('app/public/' . $book->file_path);
        $bookSourceUrl = File::exists($storagePath)
            ? route('book.stream', $book)
            : null;

        $dummyTotalPages = self::DUMMY_TOTAL_PAGES;

        return view('book.read', compact('book', 'progress', 'bookSourceUrl', 'dummyTotalPages', 'currentDummyPage'));
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
            'page' => ['nullable', 'integer', 'min:1', 'max:' . self::DUMMY_TOTAL_PAGES],
            'current_location' => ['nullable', 'string', 'max:255'],
        ]);

        $page = $validated['page'] ?? (int) ($validated['current_location'] ?? 1);
        $page = max(1, min(self::DUMMY_TOTAL_PAGES, $page));

        $progressPercentage = round(($page / self::DUMMY_TOTAL_PAGES) * 100, 2);

        $progress = UserBookProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'book_id' => $book->id,
            ],
            [
                'current_location' => (string) $page,
                'progress_percentage' => $progressPercentage,
                'status' => $page >= self::DUMMY_TOTAL_PAGES ? 'completed' : 'reading',
            ]
        );

        return response()->json([
            'success' => true,
            'page' => $page,
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