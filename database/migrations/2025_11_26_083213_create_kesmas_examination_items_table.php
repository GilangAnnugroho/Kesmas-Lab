<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kesmas_examination_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('registration_id')->constrained('kesmas_registrations')->cascadeOnDelete();
            $table->foreignId('parameter_id')->constrained('kesmas_parameters')->cascadeOnDelete();

            // status
            $table->enum('status', ['belum_diperiksa', 'diproses', 'selesai'])
                  ->default('belum_diperiksa');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kesmas_examination_items');
    }
};
