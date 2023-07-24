<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        $categories = Category::all();

        return Inertia::render('Products', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        \Log::info($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'image' => $request->hasFile('image') ? 'image|mimes:jpeg,png,jpg,gif|max:2048' : 'nullable', // Add validation for the image
        ]);

        if ($validator->fails()) {
            // Return a JSON response with validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY); // HTTP 422 Unprocessable Entity status code
        }

        // Handle the image upload and store the image path
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = null;
        }

        $product = new Product([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'category_id' => $request->input('category_id'),
            'image' => $imagePath, // Store the image path in the 'image' column
        ]);

        $product->save();

        // Return a JSON response with a success message
        return response()->json([
            'message' => 'Product created successfully!',
            'product' => $product,
        ]);
    }

    public function update(Request $request, $id)
    {
        \Log::info($request->all());
        // Find the product by ID
        $product = Product::find($id);

        // Check if the product exists
        if (!$product) {
            return response()->json([
                'error' => 'Product not found!',
            ], Response::HTTP_NOT_FOUND); // HTTP 404 Not Found status code
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'image' => $request->hasFile('image') ? 'image|mimes:jpeg,png,jpg,gif|max:2048' : 'nullable', // Add validation for the image
        ]);

        if ($validator->fails()) {
            // Return a JSON response with validation errors
            return response()->json([
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY); // HTTP 422 Unprocessable Entity status code
        }
        // Handle the image upload and update the image path if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the existing image from storage if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Store the new image and update the image path
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // Update the product data
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->category_id = $request->input('category_id');

        $product->save();

        // Return a JSON response with a success message
        return response()->json([
            'message' => 'Product updated successfully!',
            'product' => $product,
        ]);
    }


    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::find($id);

        // Check if the product exists
        if (!$product) {
            return response()->json([
                'error' => 'Product not found!',
            ], Response::HTTP_NOT_FOUND); // HTTP 404 Not Found status code
        }

        // Delete the associated image from storage if it exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Delete the product from the database
        $product->delete();

        // Return a JSON response with a success message
        return response()->json([
            'message' => 'Product deleted successfully!',
        ]);
    }
}
