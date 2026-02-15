<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kesmas_parameters', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori', ['mikrobiologi', 'kimia']);
            $table->string('nama_parameter');
            $table->string('satuan')->nullable();
            $table->string('nilai_rujukan')->nullable(); // ex: "<50/100ml", "Negatif"
            $table->text('deskripsi')->nullable();

            $table->boolean('aktif')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kesmas_parameters');
    }
};
