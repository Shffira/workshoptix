<?php

namespace App\Http\Controllers;

use App\Models\Workshop;

class WorkshopController extends Controller
{
    /**
     * List all active workshops.
     */
    public function index()
    {
        $workshops = Workshop::where('is_active', true)
            ->withCount([
                'registrations as registered_count' => fn ($q) => $q->where('status', '!=', 'cancelled'),
            ])
            ->latest()
            ->paginate(9);

        return view('workshops.index', compact('workshops'));
    }

    /**
     * Show a single workshop.
     */
    public function show(Workshop $workshop)
    {
        $isRegistered = false;

        if (auth()->check()) {
            $isRegistered = $workshop->registrations()
                ->where('user_id', auth()->id())
                ->where('status', '!=', 'cancelled')
                ->exists();
        }

        $registeredCount = $workshop->registrations()
            ->where('status', '!=', 'cancelled')
            ->count();

        return view('workshops.show', compact('workshop', 'isRegistered', 'registeredCount'));
    }
}
