<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WorkshopController extends Controller
{
    public function index()
    {
        $workshops = Workshop::withCount([
            'registrations as registered_count' => function ($query) {
                $query->where('status', '!=', 'cancelled');
            }
        ])
        ->latest()
        ->paginate(10);

        return view('admin.workshops.index', compact('workshops'));
    }

    public function create()
    {
        return view('admin.workshops.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'speaker' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'start_at' => ['required', 'date', 'after:now'],
            'end_at' => ['required', 'date', 'after:start_at'],
            'quota' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'integer', 'min:0'],
            'category' => ['required', 'string', 'max:100'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['boolean'],
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('workshops', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->boolean('is_active', true);

        Workshop::create($validated);

        return redirect()->route('admin.workshops.index')
            ->with('success', 'Workshop berhasil dibuat.');
    }

    public function show(Workshop $workshop)
    {
        $registrations = $workshop->registrations()
            ->with('user')
            ->latest()
            ->paginate(20);

        return view('admin.workshops.show', compact('workshop', 'registrations'));
    }

    public function edit(Workshop $workshop)
    {
        return view('admin.workshops.edit', compact('workshop'));
    }

    public function update(Request $request, Workshop $workshop)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'speaker' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date', 'after:start_at'],
            'quota' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'integer', 'min:0'],
            'category' => ['required', 'string', 'max:100'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['boolean'],
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('workshops', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $workshop->update($validated);

        return redirect()->route('admin.workshops.index')
            ->with('success', 'Workshop berhasil diperbarui.');
    }

    public function destroy(Workshop $workshop)
    {
        $workshop->delete();

        return redirect()->route('admin.workshops.index')
            ->with('success', 'Workshop berhasil dihapus.');
    }
}
