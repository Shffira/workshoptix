<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'speaker',
        'location',
        'start_at',
        'end_at',
        'quota',
        'price',
        'category',
        'thumbnail',
        'is_active',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'is_active' => 'boolean',
        'price' => 'integer',
        'quota' => 'integer',
    ];

    /**
     * Boot the model and auto-generate slug.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Workshop $workshop) {
            if (empty($workshop->slug)) {
                $workshop->slug = Str::slug($workshop->title);
            }
        });
    }

    /**
     * Get formatted price.
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get remaining seats.
     */
    public function getRemainingSeatsAttribute(): int
    {
        return $this->quota - $this->registrations()->where('status', '!=', 'cancelled')->count();
    }

    /**
     * Check if workshop is full.
     */
    public function isFullAttribute(): bool
    {
        return $this->remaining_seats <= 0;
    }

    /**
     * Workshop's registrations.
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Route model binding by slug.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
