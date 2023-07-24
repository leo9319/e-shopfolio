<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::paginate(10);

        return Inertia::render('Categories', [
            'categories' => $categories,
        ]);
    }

    public function getAll() {
        return Category::all();
    }
}
