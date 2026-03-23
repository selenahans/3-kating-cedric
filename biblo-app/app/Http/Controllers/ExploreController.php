<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExploreController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));
        $categoryId = $request->integer('category');
        $sort = $request->query('sort', 'latest');

        $genres = Category::orderBy('name')->get();
        $preferredCategoryIds = $request->user()
            ->preferredCategories()
            ->pluck('categories.id');

        $baseQuery = Book::with('category');

        if ($search !== '') {
            $baseQuery->where(function (Builder $query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function (Builder $categoryQuery) use ($search) {
                        $categoryQuery->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($categoryId) {
            $baseQuery->where('category_id', $categoryId);
        }

        $filteredBooksQuery = clone $baseQuery;

        switch ($sort) {
            case 'title':
                $filteredBooksQuery->orderBy('title');
                break;
            case 'author':
                $filteredBooksQuery->orderBy('author');
                break;
            case 'oldest':
                $filteredBooksQuery->oldest();
                break;
            case 'latest':
            default:
                $filteredBooksQuery->latest();
                break;
        }

        $filteredBooks = $filteredBooksQuery->take(15)->get();

        if ($search !== '' || $categoryId) {
            $recommendedBooks = $filteredBooks;
        } else {
            $recommendedBooks = Book::with('category')
                ->when($preferredCategoryIds->isNotEmpty(), function (Builder $query) use ($preferredCategoryIds) {
                    $query->whereIn('category_id', $preferredCategoryIds);
                })
                ->inRandomOrder()
                ->take(5)
                ->get();

            if ($recommendedBooks->count() < 5) {
                $recommendedBooks = Book::with('category')->inRandomOrder()->take(5)->get();
            }
        }

        $popularBooks = Book::with('category')
            ->withCount('progressRecords')
            ->orderByDesc('progress_records_count')
            ->latest()
            ->take(5)
            ->get();

        $newArrivals = Book::with('category')->latest()->take(5)->get();

        return view('explore', compact(
            'recommendedBooks',
            'genres',
            'popularBooks',
            'newArrivals',
            'filteredBooks',
            'search',
            'categoryId',
            'sort'
        ));
    }
}