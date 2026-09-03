<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {

        $data = $request->validated();

        $category = Category::create($data);

        return $category;
    }



    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

        return $category;
    }


    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->validated());

        return $category;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $hasProduct = \App\Models\Product::where('category_id', $category->id)->exists();

        if ($hasProduct) {
            return response()->json([
                'message' => 'Categoria nao encontrada',
            ], 422);
        }

        $category->delete();

        return response()->json([
            'message' => 'Cetegorai excluida',
        ], 204);
    }
}
