<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(Request $request): View
    {
        $query = Service::with('category');

        if ($request->filled('search')) {
            $search = $request->query('search');
            $query->where('title', 'like', "%{$search}%");
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->query('category_id'));
        }

        $services = $query->orderBy('order')->paginate(10)->withQueryString();
        $categories = Category::where('type', 'service')->get();

        return view('admin.services.index', compact('services', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::where('type', 'service')->get();

        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'icon' => ['nullable', 'string', 'max:50'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string'],
            'featured_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:5120'],
            'featured_image_url' => ['nullable', 'string', 'max:1000'],
            'features_text' => ['nullable', 'string'],
            'benefits_text' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);

        $imagePath = $validated['featured_image_url'] ?? null;
        if ($request->hasFile('featured_image_file')) {
            $imagePath = $request->file('featured_image_file')->store('services', 'public');
        }

        $features = [];
        if (! empty($validated['features_text'])) {
            $features = array_values(array_filter(array_map('trim', explode("\n", $validated['features_text']))));
        }

        $benefits = [];
        if (! empty($validated['benefits_text'])) {
            $benefits = array_values(array_filter(array_map('trim', explode("\n", $validated['benefits_text']))));
        }

        $slug = Service::generateSlug($validated['title']);

        Service::create([
            'category_id' => $validated['category_id'] ?? null,
            'title' => $validated['title'],
            'slug' => $slug,
            'icon' => $validated['icon'] ?? 'bi-gear-fill',
            'tagline' => $validated['tagline'] ?? null,
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'featured_image' => $imagePath,
            'features' => $features,
            'benefits' => $benefits,
            'is_featured' => $request->has('is_featured'),
            'status' => $request->has('status'),
            'order' => $validated['order'] ?? 0,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Corporate service record added.');
    }

    public function edit(Service $service): View
    {
        $categories = Category::where('type', 'service')->get();

        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'icon' => ['nullable', 'string', 'max:50'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string'],
            'featured_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:5120'],
            'featured_image_url' => ['nullable', 'string', 'max:1000'],
            'features_text' => ['nullable', 'string'],
            'benefits_text' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);

        $imagePath = $service->featured_image;
        if ($request->hasFile('featured_image_file')) {
            if ($service->featured_image && Storage::disk('public')->exists($service->featured_image)) {
                Storage::disk('public')->delete($service->featured_image);
            }
            $imagePath = $request->file('featured_image_file')->store('services', 'public');
        } elseif (! empty($validated['featured_image_url'])) {
            $imagePath = $validated['featured_image_url'];
        }

        $features = $service->features ?? [];
        if (isset($validated['features_text'])) {
            $features = array_values(array_filter(array_map('trim', explode("\n", $validated['features_text']))));
        }

        $benefits = $service->benefits ?? [];
        if (isset($validated['benefits_text'])) {
            $benefits = array_values(array_filter(array_map('trim', explode("\n", $validated['benefits_text']))));
        }

        $service->update([
            'category_id' => $validated['category_id'] ?? null,
            'title' => $validated['title'],
            'icon' => $validated['icon'] ?? $service->icon,
            'tagline' => $validated['tagline'] ?? null,
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'featured_image' => $imagePath,
            'features' => $features,
            'benefits' => $benefits,
            'is_featured' => $request->has('is_featured'),
            'status' => $request->has('status'),
            'order' => $validated['order'] ?? 0,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        if ($service->featured_image && Storage::disk('public')->exists($service->featured_image)) {
            Storage::disk('public')->delete($service->featured_image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    public function toggleStatus(Service $service): RedirectResponse
    {
        $service->status = ! $service->status;
        $service->save();

        return redirect()->back()->with('success', 'Service status changed to '.($service->status ? 'Active' : 'Inactive').'.');
    }
}
