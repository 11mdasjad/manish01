<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with('category')->active();

        if ($request->filled('category')) {
            $categorySlug = $request->query('category');
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($request->filled('search')) {
            $search = $request->query('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('meta_keywords', 'like', "%{$search}%");
            });
        }

        $sort = $request->query('sort', 'latest');
        if ($sort === 'featured') {
            $query->orderBy('is_featured', 'desc')->orderBy('order');
        } elseif ($sort === 'name_asc') {
            $query->orderBy('name', 'asc');
        } else {
            $query->orderBy('order')->latest();
        }

        $products = $query->paginate(9)->withQueryString();
        $categories = Category::where('type', 'product')->where('is_active', true)->withCount('products')->get();
        $selectedCategory = $request->filled('category') ? Category::where('slug', $request->query('category'))->first() : null;

        return view('pages.products.index', compact('products', 'categories', 'selectedCategory'));
    }

    public function show(string $slug): View
    {
        $product = Product::with('category')->where('slug', $slug)->active()->firstOrFail();

        $relatedProducts = Product::with('category')
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->active()
            ->take(3)
            ->get();

        if ($relatedProducts->isEmpty()) {
            $relatedProducts = Product::with('category')
                ->where('id', '!=', $product->id)
                ->active()
                ->take(3)
                ->get();
        }

        return view('pages.products.show', compact('product', 'relatedProducts'));
    }
}
