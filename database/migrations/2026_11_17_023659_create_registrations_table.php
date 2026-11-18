<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('workshop_id')->constrained()->cascadeOnDelete();
            $table->string('ticket_code')->unique();
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->string('snap_token')->nullable();
            $table->string('payment_id')->nullable(); // Midtrans order_id
            $table->unsignedBigInteger('amount'); // amount paid in IDR
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            // Prevent duplicate registration
            $table->unique(['user_id', 'workshop_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
