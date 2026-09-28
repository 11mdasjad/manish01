<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $search = $request->query('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->query('category_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->query('status') == '1');
        }

        $products = $query->orderBy('order')->latest()->paginate(10)->withQueryString();
        $categories = Category::where('type', 'product')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::where('type', 'product')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'sku' => ['nullable', 'string', 'max:100'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'price_range' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string'],
            'featured_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:5120'],
            'featured_image_url' => ['nullable', 'url', 'max:1000'],
            'features_text' => ['nullable', 'string'],
            'specifications_json' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
        ]);

        $imagePath = $validated['featured_image_url'] ?? null;
        if ($request->hasFile('featured_image_file')) {
            $path = $request->file('featured_image_file')->store('products', 'public');
            $imagePath = $path;
        }

        $features = [];
        if (!empty($validated['features_text'])) {
            $features = array_values(array_filter(array_map('trim', explode("\n", $validated['features_text']))));
        }

        $specifications = null;
        if (!empty($validated['specifications_json'])) {
            $decoded = json_decode($validated['specifications_json'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $specifications = $decoded;
            }
        }

        $slug = Product::generateSlug($validated['name']);

        Product::create([
            'category_id' => $validated['category_id'] ?? null,
            'name' => $validated['name'],
            'slug' => $slug,
            'sku' => $validated['sku'] ?? null,
            'tagline' => $validated['tagline'] ?? null,
            'price_range' => $validated['price_range'] ?? null,
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'featured_image' => $imagePath,
            'features' => $features,
            'specifications' => $specifications,
            'is_featured' => $request->has('is_featured'),
            'status' => $request->has('status'),
            'order' => $validated['order'] ?? 0,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product record created successfully.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::where('type', 'product')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'sku' => ['nullable', 'string', 'max:100'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'price_range' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string'],
            'featured_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:5120'],
            'featured_image_url' => ['nullable', 'url', 'max:1000'],
            'features_text' => ['nullable', 'string'],
            'specifications_json' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
        ]);

        $imagePath = $product->featured_image;
        if ($request->hasFile('featured_image_file')) {
            if ($product->featured_image && Storage::disk('public')->exists($product->featured_image)) {
                Storage::disk('public')->delete($product->featured_image);
            }
            $imagePath = $request->file('featured_image_file')->store('products', 'public');
        } elseif (!empty($validated['featured_image_url'])) {
            $imagePath = $validated['featured_image_url'];
        }

        $features = $product->features ?? [];
        if (isset($validated['features_text'])) {
            $features = array_values(array_filter(array_map('trim', explode("\n", $validated['features_text']))));
        }

        $specifications = $product->specifications;
        if (!empty($validated['specifications_json'])) {
            $decoded = json_decode($validated['specifications_json'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $specifications = $decoded;
            }
        }

        $product->update([
            'category_id' => $validated['category_id'] ?? null,
            'name' => $validated['name'],
            'sku' => $validated['sku'] ?? null,
            'tagline' => $validated['tagline'] ?? null,
            'price_range' => $validated['price_range'] ?? null,
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'featured_image' => $imagePath,
            'features' => $features,
            'specifications' => $specifications,
            'is_featured' => $request->has('is_featured'),
            'status' => $request->has('status'),
            'order' => $validated['order'] ?? 0,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product record updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->featured_image && Storage::disk('public')->exists($product->featured_image)) {
            Storage::disk('public')->delete($product->featured_image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function toggleStatus(Product $product): RedirectResponse
    {
        $product->status = !$product->status;
        $product->save();

        return redirect()->back()->with('success', "Product status changed to " . ($product->status ? 'Active' : 'Inactive') . ".");
    }
}
