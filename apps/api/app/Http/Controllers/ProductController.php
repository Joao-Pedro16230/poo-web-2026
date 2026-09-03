<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        return Product::paginate();
    }

    public function store(ProductRequest $request)
    {

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();

        return $product;
    }


    public function show(Product $product)
    {
        return $product;
    }

    public function update(ProductRequest $request, Product $product)
    {

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }
        $product->name = $request->name ?? $product->name;
        $product->description = $request->description ?? $product->description;

        $product->save();

        return $product;

    }

    public function destroy(Product $product)
    {
        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'produto excluida'], 200);
    }

}