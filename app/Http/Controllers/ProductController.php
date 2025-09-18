<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class ProductController extends Controller
{
    // GET /api/products
    public function index(Request $request)
    {
        try {
            $query = Product::query();

            if ($request->filled('min_price')) {
                $query->where('price', '>=', (float) $request->query('min_price'));
            }
            if ($request->filled('max_price')) {
                $query->where('price', '<=', (float) $request->query('max_price'));
            }

            $products = $query->get();

            return response()->json([
                'status'  => true,
                'message' => 'Products retrieved successfully',
                'data'    => $products
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch products',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // POST /api/products
    public function store(ProductRequest $request)
    {
        try {
            $product = Product::create($request->validated());

            return response()->json([
                'status'  => true,
                'message' => 'Product created successfully',
                'data'    => $product
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to create product',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // GET /api/products/{id}
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);

            return response()->json([
                'status'  => true,
                'message' => 'Product retrieved successfully',
                'data'    => $product
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Product not found',
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to fetch product',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // PUT /api/products/{id}
    public function update(ProductRequest $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->update($request->validated());

            return response()->json([
                'status'  => true,
                'message' => 'Product updated successfully',
                'data'    => $product
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Product not found',
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to update product',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // DELETE /api/products/{id}
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json([
                'status'  => true,
                'message' => 'Product deleted successfully',
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Product not found',
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to delete product',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
