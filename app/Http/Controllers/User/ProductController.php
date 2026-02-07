<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'desc')->get();

        return view('user.products.index', compact('products'));
    }
    public function show(Request $request, $id = null)
    {
        $productId = $id ?: $request->query('id');

        if ($productId) {
            $product = Product::with(['category', 'specifications'])->find($productId);
        } else {
            $product = Product::with(['category', 'specifications'])->orderBy('created_at', 'desc')->first();
        }

        if (!$product) {
            return redirect()->route('products')->with('danger', 'Record Not Found');
        }

        $category = $product->category;
        $specs = $product->specifications;

        return view('user.products.show', compact('product', 'category', 'specs'));
    }

    public function file($id)
    {
        $product = Product::find($id);
        if (!$product || !$product->file) {
            abort(404);
        }

        $filePath = str_replace('\\', '/', $product->file);
        $publicPath = public_path($filePath);
        $basePath = base_path($filePath);

        if (file_exists($publicPath)) {
            $fullPath = $publicPath;
        } elseif (file_exists($basePath)) {
            $fullPath = $basePath;
        } else {
            abort(404);
        }

        return response()->file($fullPath);
    }
}
