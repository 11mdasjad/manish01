<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $query = Blog::with('category');

        if ($request->filled('search')) {
            $search = $request->query('search');
            $query->where('title', 'like', "%{$search}%");
        }

        if ($request->filled('category_id')) {
            $query->where('blog_category_id', $request->query('category_id'));
        }

        $blogs = $query->latest('published_at')->paginate(10)->withQueryString();
        $categories = BlogCategory::all();

        return view('admin.blogs.index', compact('blogs', 'categories'));
    }

    public function create(): View
    {
        $categories = BlogCategory::all();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'blog_category_id' => ['nullable', 'exists:blog_categories,id'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'author_name' => ['nullable', 'string', 'max:150'],
            'reading_time' => ['nullable', 'string', 'max:50'],
            'featured_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'featured_image_url' => ['nullable', 'url', 'max:1000'],
            'tags_text' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);

        $imagePath = $validated['featured_image_url'] ?? null;
        if ($request->hasFile('featured_image_file')) {
            $imagePath = $request->file('featured_image_file')->store('blogs', 'public');
        }

        $tags = [];
        if (!empty($validated['tags_text'])) {
            $tags = array_values(array_filter(array_map('trim', explode(',', $validated['tags_text']))));
        }

        $slug = Blog::generateSlug($validated['title']);

        Blog::create([
            'blog_category_id' => $validated['blog_category_id'] ?? null,
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'featured_image' => $imagePath,
            'author_name' => $validated['author_name'] ?? 'HarshMais Corporate',
            'reading_time' => $validated['reading_time'] ?? '5 min read',
            'tags' => $tags,
            'is_featured' => $request->has('is_featured'),
            'is_published' => $request->has('is_published'),
            'published_at' => $request->has('is_published') ? now() : null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Article published successfully.');
    }

    public function edit(Blog $blog): View
    {
        $categories = BlogCategory::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'blog_category_id' => ['nullable', 'exists:blog_categories,id'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'author_name' => ['nullable', 'string', 'max:150'],
            'reading_time' => ['nullable', 'string', 'max:50'],
            'featured_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'featured_image_url' => ['nullable', 'url', 'max:1000'],
            'tags_text' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);

        $imagePath = $blog->featured_image;
        if ($request->hasFile('featured_image_file')) {
            if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $imagePath = $request->file('featured_image_file')->store('blogs', 'public');
        } elseif (!empty($validated['featured_image_url'])) {
            $imagePath = $validated['featured_image_url'];
        }

        $tags = $blog->tags ?? [];
        if (isset($validated['tags_text'])) {
            $tags = array_values(array_filter(array_map('trim', explode(',', $validated['tags_text']))));
        }

        $isPublished = $request->has('is_published');
        $publishedAt = $blog->published_at;
        if ($isPublished && !$blog->is_published) {
            $publishedAt = now();
        }

        $blog->update([
            'blog_category_id' => $validated['blog_category_id'] ?? null,
            'title' => $validated['title'],
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'featured_image' => $imagePath,
            'author_name' => $validated['author_name'] ?? $blog->author_name,
            'reading_time' => $validated['reading_time'] ?? $blog->reading_time,
            'tags' => $tags,
            'is_featured' => $request->has('is_featured'),
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Article updated.');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Article deleted.');
    }
}
