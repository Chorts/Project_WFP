<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('name');
            $table->string('phone', 20)->nullable()->after('specialization_id');
            $table->text('bio')->nullable()->after('phone');
            $table->unsignedInteger('experience_years')->nullable()->after('bio');
        });
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['photo', 'phone', 'bio', 'experience_years']);
        });
    }
};
