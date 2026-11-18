<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Registration::with(['user', 'workshop'])
            ->latest()
            ->paginate(20);

        return view('admin.payments.index', compact('payments'));
    }
}
