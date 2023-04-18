<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $product = Product::create(array(
            'name' => $request->name,
            'description' => $request->description,
            'categories_id' => $request->categories_id,
            'price' => $request->price,
            'characteristics' => $request->characteristics,
        ));

        return response()->json([
            'status' => 'success',
            'message' => 'product created successfully',
        ]);
    }


    public function getBySlug($slug)
    {
        return Product::where('slug', $slug)->firstOrFail();
    }


    public function index(Request $request)
    {
        $categoryIds = $request->input('category_ids');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        // Валидация параметров запроса
        $validatedData = $request->validate([
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:' . ($minPrice ?? 0),
        ]);

        $query = Product::query();

        if (!empty($categoryIds)) {
            // Получение всех потомков выбранных категорий
            $categories = Category::whereIn('id', $categoryIds)->with('children')->get();
            $categoryIds = $categories->pluck('id')->toArray();
            foreach ($categories as $category) {
                $categoryIds = array_merge($categoryIds, $category->children->pluck('id')->toArray());
            }

            $query->whereIn('categories_id', $categoryIds);
        }

        if (!empty($minPrice)) {
            $query->where('price', '>=', $minPrice);
        }

        if (!empty($maxPrice)) {
            $query->where('price', '<=', $maxPrice);
        }

        $products = $query->get();

        return response()->json($products);
    }
}