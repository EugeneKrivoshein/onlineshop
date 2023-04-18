<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function store(Request $request)
    {
        $category = Category::create(array(
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ));

        return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully',
        ]);
    }


    public function getAllCategories()
    {
        $categories = Category::where('parent_id', null)->get();
        return $this->getSubcategories($categories);
    }

    private function getSubcategories($categories)
    {
        $result = [];

        foreach ($categories as $category) {
            $subcategories = Category::where('parent_id', $category->id)->get();

            if ($subcategories->count() > 0) {
                $category->subcategories = $this->getSubcategories($subcategories);
            }

            $result[] = $category;
        }

        return $result;
    }

}
