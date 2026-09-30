<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::orderBy('order')->paginate(10);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'client_name' => ['required', 'string', 'max:255'],
            'client_title' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'content' => ['required', 'string'],
            'avatar_url' => ['nullable', 'string', 'max:1000'],
            'avatar_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'project_reference' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
            'status' => ['nullable', 'boolean'],
        ]);

        $avatar = $validated['avatar_url'] ?? null;
        if ($request->hasFile('avatar_file')) {
            $avatar = $request->file('avatar_file')->store('testimonials', 'public');
        }

        Testimonial::create([
            'client_name' => $validated['client_name'],
            'client_title' => $validated['client_title'] ?? null,
            'company' => $validated['company'] ?? null,
            'rating' => $validated['rating'],
            'content' => $validated['content'],
            'avatar' => $avatar,
            'project_reference' => $validated['project_reference'] ?? null,
            'order' => $validated['order'] ?? 0,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $request->validate([
            'client_name' => ['required', 'string', 'max:255'],
            'client_title' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'content' => ['required', 'string'],
            'avatar_url' => ['nullable', 'string', 'max:1000'],
            'avatar_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'project_reference' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
            'status' => ['nullable', 'boolean'],
        ]);

        $avatar = $testimonial->avatar;
        if ($request->hasFile('avatar_file')) {
            $avatar = $request->file('avatar_file')->store('testimonials', 'public');
        } elseif (! empty($validated['avatar_url'])) {
            $avatar = $validated['avatar_url'];
        }

        $testimonial->update([
            'client_name' => $validated['client_name'],
            'client_title' => $validated['client_title'] ?? null,
            'company' => $validated['company'] ?? null,
            'rating' => $validated['rating'],
            'content' => $validated['content'],
            'avatar' => $avatar,
            'project_reference' => $validated['project_reference'] ?? null,
            'order' => $validated['order'] ?? 0,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted.');
    }
}
