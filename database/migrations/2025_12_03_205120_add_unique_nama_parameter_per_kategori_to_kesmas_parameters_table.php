<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kesmas_parameters', function (Blueprint $table) {
            // kombinasi (nama_parameter, kategori) harus unik
            $table->unique(['nama_parameter', 'kategori'], 'kesmas_params_nama_kategori_unique');
        });
    }

    public function down(): void
    {
        Schema::table('kesmas_parameters', function (Blueprint $table) {
            $table->dropUnique('kesmas_params_nama_kategori_unique');
            // atau: $table->dropUnique(['nama_parameter', 'kategori']);
        });
    }
};
