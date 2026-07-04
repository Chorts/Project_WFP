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
        Schema::create('consultations', function (Blueprint $table) {

            $table->id();

            $table->foreignId('booking_id')
                ->constrained('bookings');

            $table->foreignId('doctor_id')
                ->constrained('doctors');

            $table->foreignId('user_id')
                ->constrained('users');

            $table->text('ringkasan');

            $table->enum('status', [
                'Aktif',
                'Selesai'
            ])->default('Aktif');

            $table->timestamp('started_at')->nullable();

            $table->timestamp('ended_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
