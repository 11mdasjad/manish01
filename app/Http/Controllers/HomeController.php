<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use App\Models\Project;
use App\Models\Category;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\Client;
use App\Models\Blog;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProducts = Product::with('category')
            ->active()
            ->featured()
            ->orderBy('order')
            ->take(6)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::with('category')->active()->take(6)->get();
        }

        $featuredServices = Service::with('category')
            ->active()
            ->featured()
            ->orderBy('order')
            ->take(4)
            ->get();

        if ($featuredServices->isEmpty()) {
            $featuredServices = Service::with('category')->active()->take(4)->get();
        }

        $featuredProjects = Project::with('category')
            ->active()
            ->featured()
            ->orderBy('order')
            ->take(4)
            ->get();

        if ($featuredProjects->isEmpty()) {
            $featuredProjects = Project::with('category')->active()->take(4)->get();
        }

        $testimonials = Testimonial::active()->orderBy('order')->take(6)->get();
        $clients = Client::active()->orderBy('order')->get();
        $latestBlogs = Blog::with('category')->published()->latest('published_at')->take(3)->get();
        $categories = Category::where('is_active', true)->whereNull('parent_id')->orderBy('order')->get();

        return view('pages.home', compact(
            'featuredProducts',
            'featuredServices',
            'featuredProjects',
            'testimonials',
            'clients',
            'latestBlogs',
            'categories'
        ));
    }
}
