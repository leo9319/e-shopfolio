<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index() {

        $products = Product::with('category')->paginate(10);

        return Inertia::render('Home', [
            'products' => $products,
        ]);
    }
}
