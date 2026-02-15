<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration { 
    public function up(): void
    {
        Schema::create('kesmas_registrations', function (Blueprint $table) {
            $table->id();

            // relasi ke client/pemohon
            $table->foreignId('client_id')->nullable()->constrained('kesmas_clients')->nullOnDelete();

            // nomor register otomatis (KES-2025-00001)
            $table->string('no_registrasi')->unique();

            // Identitas dasar
            $table->string('nama_sampel');
            $table->string('identitas_pengirim')->nullable();
            $table->string('lokasi_pengambilan')->nullable();
            $table->string('jenis_sampel')->nullable();
            $table->string('jenis_pemeriksaan')->nullable(); // mikro / kimia / kombinasi

            // Pengambilan sampel
            $table->string('petugas_sampling')->nullable();
            $table->string('alamat_petugas_sampling')->nullable();
            $table->date('tgl_pengambilan')->nullable();
            $table->time('jam_pengambilan')->nullable();

            // Permintaan & penerimaan
            $table->date('tgl_permintaaan')->nullable();
            $table->date('tgl_penerimaan')->nullable();
            $table->time('jam_penerimaan')->nullable();

            $table->string('volume_sampel')->nullable();

            // Status pembayaran
            $table->enum('status_pembayaran', ['lunas', 'belum_lunas'])->default('belum_lunas');

            // Status proses
            $table->enum('status_proses', [
                'baru',            // baru masuk
                'diterima',        // sudah diterima petugas
                'sedang_diperiksa',
                'selesai'
            ])->default('baru');

            // sumber / catatan lain
            $table->text('sumber')->nullable();

            // jejak input
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kesmas_registrations');
    }
};
