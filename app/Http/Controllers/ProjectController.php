<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $query = Project::with('category')->active();

        if ($request->filled('sector')) {
            $query->where('sector', $request->query('sector'));
        }

        if ($request->filled('category')) {
            $categorySlug = $request->query('category');
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        $projects = $query->orderBy('order')->latest()->paginate(9)->withQueryString();
        $sectors = Project::active()->whereNotNull('sector')->distinct()->pluck('sector');
        $categories = Category::where('type', 'project')->where('is_active', true)->get();

        return view('pages.projects.index', compact('projects', 'sectors', 'categories'));
    }

    public function show(string $slug): View
    {
        $project = Project::with('category')->where('slug', $slug)->active()->firstOrFail();

        $relatedProjects = Project::with('category')
            ->where('id', '!=', $project->id)
            ->active()
            ->take(3)
            ->get();

        return view('pages.projects.show', compact('project', 'relatedProjects'));
    }
}
