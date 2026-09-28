<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $query = Blog::with('category')->published();

        if ($request->filled('category')) {
            $categorySlug = $request->query('category');
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($request->filled('search')) {
            $search = $request->query('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $featuredBlog = Blog::with('category')->published()->featured()->latest('published_at')->first();
        if (!$featuredBlog) {
            $featuredBlog = Blog::with('category')->published()->latest('published_at')->first();
        }

        $blogs = $query->latest('published_at')->paginate(6)->withQueryString();
        $categories = BlogCategory::withCount('blogs')->get();
        $recentPosts = Blog::published()->latest('published_at')->take(4)->get();

        return view('pages.blog.index', compact('blogs', 'categories', 'featuredBlog', 'recentPosts'));
    }

    public function show(string $slug): View
    {
        $blog = Blog::with('category')->where('slug', $slug)->published()->firstOrFail();

        $relatedBlogs = Blog::with('category')
            ->where('id', '!=', $blog->id)
            ->where('blog_category_id', $blog->blog_category_id)
            ->published()
            ->take(3)
            ->get();

        if ($relatedBlogs->isEmpty()) {
            $relatedBlogs = Blog::with('category')->where('id', '!=', $blog->id)->published()->take(3)->get();
        }

        $categories = BlogCategory::withCount('blogs')->get();
        $recentPosts = Blog::published()->where('id', '!=', $blog->id)->latest('published_at')->take(4)->get();

        return view('pages.blog.show', compact('blog', 'relatedBlogs', 'categories', 'recentPosts'));
    }
}
