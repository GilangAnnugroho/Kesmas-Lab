<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kesmas_registrations', function (Blueprint $table) {
            // RENAME kolom 3 a -> 2 a
            if (Schema::hasColumn('kesmas_registrations', 'tgl_permintaaan')) {
                $table->renameColumn('tgl_permintaaan', 'tgl_permintaan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kesmas_registrations', function (Blueprint $table) {
            // Balikin lagi kalau di-rollback
            if (Schema::hasColumn('kesmas_registrations', 'tgl_permintaan')) {
                $table->renameColumn('tgl_permintaan', 'tgl_permintaaan');
            }
        });
    }
};
