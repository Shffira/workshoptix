<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = User::where('is_admin', false)
            ->withCount('registrations')
            ->latest()
            ->paginate(20);

        return view('admin.participants.index', compact('participants'));
    }
}
