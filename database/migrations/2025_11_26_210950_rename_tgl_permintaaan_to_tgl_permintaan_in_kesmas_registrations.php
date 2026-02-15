<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kesmas_registrations', function (Blueprint $table) {
            // Rename hanya jika kolom lama *ada*
            if (Schema::hasColumn('kesmas_registrations', 'tgl_permintaaan')) {
                $table->renameColumn('tgl_permintaaan', 'tgl_permintaan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kesmas_registrations', function (Blueprint $table) {
            // Kembalikan ke nama lama jika rollback
            if (Schema::hasColumn('kesmas_registrations', 'tgl_permintaan')) {
                $table->renameColumn('tgl_permintaan', 'tgl_permintaaan');
            }
        });
    }
};
