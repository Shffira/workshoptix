<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'workshop_id',
        'ticket_code',
        'status',
        'snap_token',
        'payment_id',
        'amount',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'amount' => 'integer',
    ];

    /**
     * Boot the model and auto-generate ticket code.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Registration $registration) {
            if (empty($registration->ticket_code)) {
                $registration->ticket_code = 'WTX-' . strtoupper(Str::random(8));
            }
        });
    }

    /**
     * Registration's user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Registration's workshop.
     */
    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    /**
     * Check if registration is paid.
     */
    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    /**
     * Mark as paid.
     */
    public function markAsPaid(string $paymentId): void
    {
        $this->update([
            'status' => 'paid',
            'payment_id' => $paymentId,
            'paid_at' => now(),
        ]);
    }
}
