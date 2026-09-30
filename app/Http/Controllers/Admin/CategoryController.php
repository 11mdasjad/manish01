<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $query = Category::withCount(['products', 'services', 'projects']);

        if ($request->filled('type')) {
            $query->where('type', $request->query('type'));
        }

        $categories = $query->orderBy('type')->orderBy('order')->paginate(15)->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        $parentCategories = Category::whereNull('parent_id')->get();

        return view('admin.categories.create', compact('parentCategories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:product,service,project,blog,gallery'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:1000'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:4096'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $imagePath = $validated['image'] ?? null;
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('categories', 'public');
        }

        $slug = Category::generateSlug($validated['name']);

        Category::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'type' => $validated['type'],
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
            'parent_id' => $validated['parent_id'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category): View
    {
        $parentCategories = Category::whereNull('parent_id')->where('id', '!=', $category->id)->get();

        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:product,service,project,blog,gallery'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:1000'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:4096'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $imagePath = $category->image;
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('categories', 'public');
        } elseif (! empty($validated['image'])) {
            $imagePath = $validated['image'];
        }

        $category->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
            'parent_id' => $validated['parent_id'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
