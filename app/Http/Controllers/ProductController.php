<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('category')->paginate(10);
        $categories = Category::all();

        return Inertia::render('Products', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
