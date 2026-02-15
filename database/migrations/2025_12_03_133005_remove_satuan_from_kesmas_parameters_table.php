<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kesmas_parameters', function (Blueprint $table) {
            if (Schema::hasColumn('kesmas_parameters', 'satuan')) {
                $table->dropColumn('satuan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kesmas_parameters', function (Blueprint $table) {
            // Tambahkan kembali kolom satuan jika di-rollback
            $table->string('satuan')->nullable();
        });
    }
};
