<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Registration::with(['user', 'workshop'])
            ->where('status', 'paid')
            ->latest()
            ->paginate(20);

        return view('admin.tickets.index', compact('tickets'));
    }
}
