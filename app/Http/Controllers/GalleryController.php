<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Gallery::active()->distinct()->pluck('category')->filter()->values();

        $query = Gallery::active();
        if ($request->filled('category') && $request->query('category') !== 'all') {
            $query->where('category', $request->query('category'));
        }

        $items = $query->orderBy('order')->paginate(12)->withQueryString();

        return view('pages.gallery', compact('items', 'categories'));
    }
}
