<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(Request $request): View
    {
        $query = Service::with('category')->active();

        if ($request->filled('category')) {
            $categorySlug = $request->query('category');
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        $services = $query->orderBy('order')->paginate(8)->withQueryString();
        $categories = Category::where('type', 'service')->where('is_active', true)->withCount('services')->get();

        return view('pages.services.index', compact('services', 'categories'));
    }

    public function show(string $slug): View
    {
        $service = Service::with('category')->where('slug', $slug)->active()->firstOrFail();

        $relatedServices = Service::with('category')
            ->where('id', '!=', $service->id)
            ->active()
            ->take(3)
            ->get();

        return view('pages.services.show', compact('service', 'relatedServices'));
    }
}
