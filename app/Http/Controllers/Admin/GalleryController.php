<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $items = Gallery::orderBy('order')->paginate(12);

        return view('admin.gallery.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'image_url' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string'],
            'order' => ['nullable', 'integer'],
            'status' => ['nullable', 'boolean'],
        ]);

        $imagePath = $validated['image_url'] ?? null;
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('gallery', 'public');
        }

        if (empty($imagePath)) {
            return back()->withErrors(['image_url' => 'Please provide an image file or direct image URL.']);
        }

        Gallery::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'image' => $imagePath,
            'description' => $validated['description'] ?? null,
            'order' => $validated['order'] ?? 0,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item uploaded.');
    }

    public function edit(Gallery $gallery): View
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'image_url' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string'],
            'order' => ['nullable', 'integer'],
            'status' => ['nullable', 'boolean'],
        ]);

        $imagePath = $gallery->image;
        if ($request->hasFile('image_file')) {
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }
            $imagePath = $request->file('image_file')->store('gallery', 'public');
        } elseif (! empty($validated['image_url'])) {
            $imagePath = $validated['image_url'];
        }

        $gallery->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'image' => $imagePath,
            'description' => $validated['description'] ?? null,
            'order' => $validated['order'] ?? 0,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted.');
    }
}
