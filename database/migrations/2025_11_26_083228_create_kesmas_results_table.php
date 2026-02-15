<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kesmas_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('examination_item_id')->constrained('kesmas_examination_items')->cascadeOnDelete();

            // hasil pemeriksaan
            $table->string('nilai_angka')->nullable(); // ex: 15, 1.2, 0
            $table->string('hasil_text')->nullable(); // ex: "Negatif", "Positif"
            $table->string('satuan')->nullable();
            $table->string('nilai_rujukan')->nullable();
            $table->text('keterangan')->nullable();

            // status hasil
            $table->enum('status_hasil', ['draft', 'menunggu_verifikasi', 'terverifikasi'])
                  ->default('draft');

            // jejak input & verifikasi
            $table->foreignId('analis_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('verifikator_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kesmas_results');
    }
};
