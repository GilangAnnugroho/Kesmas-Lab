<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kesmas_parameters', function (Blueprint $table) {
            
            // ubah nilai_rujukan ke TEXT
            if (Schema::hasColumn('kesmas_parameters', 'nilai_rujukan')) {
                $table->text('nilai_rujukan')->nullable()->change();
            }

            // tambah kolom harga (jika perlu)
            if (!Schema::hasColumn('kesmas_parameters', 'harga')) {
                $table->integer('harga')->nullable();
            }

            // tambah kolom metode pemeriksaan
            if (!Schema::hasColumn('kesmas_parameters', 'metode')) {
                $table->string('metode')->nullable();
            }

            // tambah index
            $table->index(['kategori', 'aktif']);
        });
    }

    public function down(): void
    {
        Schema::table('kesmas_parameters', function (Blueprint $table) {

            // rollback kolom baru
            if (Schema::hasColumn('kesmas_parameters', 'harga')) {
                $table->dropColumn('harga');
            }

            if (Schema::hasColumn('kesmas_parameters', 'metode')) {
                $table->dropColumn('metode');
            }

            // hapus index
            $table->dropIndex(['kategori', 'aktif']);
        });
    }
};
