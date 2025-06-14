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
        Schema::table('daftar_polis', function (Blueprint $table) {
            $table->dropUnique(['no_antrian']);
            $table->unique(['id_jadwal', 'no_antrian']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daftar_polis', function (Blueprint $table) {
            $table->dropUnique(['id_jadwal', 'no_antrian']);
            $table->unique('no_antrian');
        });
    }
};
