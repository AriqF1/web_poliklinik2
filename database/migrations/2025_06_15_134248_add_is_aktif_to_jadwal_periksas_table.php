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
        Schema::table('jadwal_periksas', function (Blueprint $table) {
            $table->boolean('is_aktif')->default(false)->after('jam_selesai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_periksas', function (Blueprint $table) {
            $table->dropColumn('is_aktif');
        });
    }
};
