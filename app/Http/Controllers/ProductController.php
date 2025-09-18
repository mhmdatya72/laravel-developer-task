<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET /api/products
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->query('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->query('max_price'));
        }

        return response()->json($query->get());
    }

    // POST /api/products
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());
        return response()->json($product, 201);
    }

    // GET /api/products/{product}  (optional, exists from apiResource)
    public function show(Product $product)
    {
        return response()->json($product);
    }

    // PUT /api/products/{product}
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return response()->json($product);
    }

    // DELETE /api/products/{product}
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
