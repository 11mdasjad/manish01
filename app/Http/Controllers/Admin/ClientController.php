<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        $clients = Client::orderBy('order')->paginate(12);
        return view('admin.clients.index', compact('clients'));
    }

    public function create(): View
    {
        return view('admin.clients.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'string', 'max:1000'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'industry' => ['nullable', 'string', 'max:150'],
            'order' => ['nullable', 'integer'],
            'status' => ['nullable', 'boolean'],
        ]);

        Client::create([
            'name' => $validated['name'],
            'logo' => $validated['logo'] ?? null,
            'website_url' => $validated['website_url'] ?? null,
            'industry' => $validated['industry'] ?? null,
            'order' => $validated['order'] ?? 0,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'Corporate partner / client added.');
    }

    public function edit(Client $client): View
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'string', 'max:1000'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'industry' => ['nullable', 'string', 'max:150'],
            'order' => ['nullable', 'integer'],
            'status' => ['nullable', 'boolean'],
        ]);

        $client->update([
            'name' => $validated['name'],
            'logo' => $validated['logo'] ?? $client->logo,
            'website_url' => $validated['website_url'] ?? null,
            'industry' => $validated['industry'] ?? null,
            'order' => $validated['order'] ?? 0,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'Client details updated.');
    }

    public function destroy(Client $client): RedirectResponse
    {
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client deleted.');
    }
}
