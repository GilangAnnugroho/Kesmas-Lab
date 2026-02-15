<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kesmas_results', function (Blueprint $table) {
            $table->text('catatan_petugas')->nullable()->after('keterangan');
        });
    }

    public function down(): void
    {
        Schema::table('kesmas_results', function (Blueprint $table) {
            $table->dropColumn('catatan_petugas');
        });
    }
};
