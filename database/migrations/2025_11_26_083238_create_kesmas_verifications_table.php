<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kesmas_verifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('registration_id')->constrained('kesmas_registrations')->cascadeOnDelete();
            $table->foreignId('verified_by')->constrained('users')->cascadeOnDelete();
            $table->timestamp('verified_at');

            $table->string('jabatan')->nullable();  
            $table->string('nama_pejabat')->nullable();
            $table->string('nip')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kesmas_verifications');
    }
};
