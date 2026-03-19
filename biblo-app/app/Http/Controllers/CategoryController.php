<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;    
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function showOnboarding()
    {
        // Fetch all categories from the database
        $categories = Category::all();

        return view('onboarding', compact('categories'));
    }
}