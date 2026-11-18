<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\WorkshopController;
use Illuminate\Support\Facades\Route;

// Home - redirect to workshops
Route::get('/', fn () => redirect()->route('workshops.index'));

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

// Public Workshop Routes
Route::get('/workshops', [WorkshopController::class, 'index'])->name('workshops.index');
Route::get('/workshops/{workshop:slug}', [WorkshopController::class, 'show'])->name('workshops.show');

// Payment Notification Webhook (no auth, no CSRF)
Route::post('/payment/notification', [RegistrationController::class, 'notification'])
    ->name('payment.notification')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// Authenticated Participant Routes
Route::middleware('auth')->group(function () {
    Route::get('/my-registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::post('/workshops/{workshop:slug}/register', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::get('/registrations/{registration}', [RegistrationController::class, 'show'])->name('registrations.show');
    Route::get('/registrations/{registration}/ticket', [RegistrationController::class, 'ticket'])->name('registrations.ticket');
    Route::get('/registrations/{registration}/payment-success', [RegistrationController::class, 'paymentSuccess'])->name('registrations.payment-success');
});


// Admin Routes
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [Admin\DashboardController::class, 'index'])
            ->name('dashboard');

        // Data Workshop
        Route::resource('workshops', Admin\WorkshopController::class);

        // Pendaftaran
        Route::resource('registrations', Admin\RegistrationController::class)
            ->only(['index', 'show']);

        // Data Peserta
        Route::get('/participants', [Admin\ParticipantController::class, 'index'])
            ->name('participants.index');

        // Tiket Digital
        Route::get('/tickets', [Admin\TicketController::class, 'index'])
            ->name('tickets.index');

        // Pembayaran
        Route::get('/payments', [Admin\PaymentController::class, 'index'])
            ->name('payments.index');
    });

