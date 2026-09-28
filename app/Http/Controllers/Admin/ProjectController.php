<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $query = Project::with('category');

        if ($request->filled('search')) {
            $search = $request->query('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('client_name', 'like', "%{$search}%");
        }

        $projects = $query->orderBy('order')->latest()->paginate(10)->withQueryString();

        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        $categories = Category::where('type', 'project')->get();
        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'sector' => ['nullable', 'string', 'max:150'],
            'completion_date' => ['nullable', 'date'],
            'budget' => ['nullable', 'string', 'max:100'],
            'scope' => ['nullable', 'string'],
            'challenge' => ['nullable', 'string'],
            'solution' => ['nullable', 'string'],
            'results' => ['nullable', 'string'],
            'featured_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:5120'],
            'featured_image_url' => ['nullable', 'url', 'max:1000'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
        ]);

        $imagePath = $validated['featured_image_url'] ?? null;
        if ($request->hasFile('featured_image_file')) {
            $imagePath = $request->file('featured_image_file')->store('projects', 'public');
        }

        $slug = Project::generateSlug($validated['title']);

        Project::create([
            'category_id' => $validated['category_id'] ?? null,
            'title' => $validated['title'],
            'slug' => $slug,
            'client_name' => $validated['client_name'] ?? null,
            'location' => $validated['location'] ?? null,
            'sector' => $validated['sector'] ?? null,
            'completion_date' => $validated['completion_date'] ?? null,
            'budget' => $validated['budget'] ?? null,
            'scope' => $validated['scope'] ?? null,
            'challenge' => $validated['challenge'] ?? null,
            'solution' => $validated['solution'] ?? null,
            'results' => $validated['results'] ?? null,
            'featured_image' => $imagePath,
            'is_featured' => $request->has('is_featured'),
            'status' => $request->has('status'),
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project portfolio record added.');
    }

    public function edit(Project $project): View
    {
        $categories = Category::where('type', 'project')->get();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'sector' => ['nullable', 'string', 'max:150'],
            'completion_date' => ['nullable', 'date'],
            'budget' => ['nullable', 'string', 'max:100'],
            'scope' => ['nullable', 'string'],
            'challenge' => ['nullable', 'string'],
            'solution' => ['nullable', 'string'],
            'results' => ['nullable', 'string'],
            'featured_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:5120'],
            'featured_image_url' => ['nullable', 'url', 'max:1000'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
        ]);

        $imagePath = $project->featured_image;
        if ($request->hasFile('featured_image_file')) {
            if ($project->featured_image && Storage::disk('public')->exists($project->featured_image)) {
                Storage::disk('public')->delete($project->featured_image);
            }
            $imagePath = $request->file('featured_image_file')->store('projects', 'public');
        } elseif (!empty($validated['featured_image_url'])) {
            $imagePath = $validated['featured_image_url'];
        }

        $project->update([
            'category_id' => $validated['category_id'] ?? null,
            'title' => $validated['title'],
            'client_name' => $validated['client_name'] ?? null,
            'location' => $validated['location'] ?? null,
            'sector' => $validated['sector'] ?? null,
            'completion_date' => $validated['completion_date'] ?? null,
            'budget' => $validated['budget'] ?? null,
            'scope' => $validated['scope'] ?? null,
            'challenge' => $validated['challenge'] ?? null,
            'solution' => $validated['solution'] ?? null,
            'results' => $validated['results'] ?? null,
            'featured_image' => $imagePath,
            'is_featured' => $request->has('is_featured'),
            'status' => $request->has('status'),
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project details updated.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        if ($project->featured_image && Storage::disk('public')->exists($project->featured_image)) {
            Storage::disk('public')->delete($project->featured_image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted.');
    }
}
