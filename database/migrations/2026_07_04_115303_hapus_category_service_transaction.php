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
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign('bookings_service_id_foreign');
            $table->dropColumn('service_id');
        });

        Schema::dropIfExists('transactions'); // references bookings only, safe anytime
        Schema::dropIfExists('services');     // references categories, must go before categories
        Schema::dropIfExists('categories');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('service_id')->constrained('services');
        });
    }
};
