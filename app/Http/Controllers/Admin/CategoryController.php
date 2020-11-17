<?php
/**
 * Created by PhpStorm.
 * User: arturchilingaryan
 * Date: 11/18/20
 * Time: 01:49
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends  Controller {

    /**
     * Functionality adding new category
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function addNewCategory(Request $request)
    {

        $request->validate([
            'hy_name' => 'required',
            'ru_name' => 'required',
            'slug' => 'required|unique:categories,slug'
        ]);

        $category = new Category();
        $category->hy_name = $request->hy_name;
        $category->ru_name = $request->ru_name;
        $category->slug = $request->slug;
        $category->saveOrFail();

        return response()->json([
                'status' => 'success',
                'message' => 'Կատեգորիան ավելացվել է',
                'category' => $category
        ]);
    }
}