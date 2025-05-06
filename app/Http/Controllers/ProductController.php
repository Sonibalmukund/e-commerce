<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('subcategories')->get();
        $products = Product::with('images')->latest()->paginate(12);
        // dd($categories);

        return view('products.index', compact('categories', 'products'));
    }

    public function filter(Request $request)
    {
        $query = Product::with('images');

        if ($request->category_id) {
            $subcategoryIds = Subcategory::where('category_id', $request->category_id)->pluck('id');
            $query->whereIn('subcategory_id', $subcategoryIds);
        }

        if ($request->subcategory_id) {
            $query->where('subcategory_id', $request->subcategory_id);
        }

        $products = $query->get();

        return response()->json([
            'html' => view('products.partials.product_list', compact('products'))->render()
        ]);
    }
}

