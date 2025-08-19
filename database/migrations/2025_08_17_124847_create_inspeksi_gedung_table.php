<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inspeksi_gedung', function (Blueprint $table) {
            $table->id();


            // Kolom status inspeksi
            $table->enum('furniture', ['Belum Diperiksa', 'Sedang Diperbaiki', 'Rusak', 'Sudah Diperbaiki'])->default('Belum Diperiksa');
            $table->enum('fire_system', ['Belum Diperiksa', 'Sedang Diperbaiki', 'Rusak', 'Sudah Diperbaiki'])->default('Belum Diperiksa');
            $table->enum('bangunan', ['Belum Diperiksa', 'Sedang Diperbaiki', 'Rusak', 'Sudah Diperbaiki'])->default('Belum Diperiksa');
            $table->enum('mekanikal_elektrikal', ['Belum Diperiksa', 'Tidak Baik', 'Baik'])->default('Belum Diperiksa');
            $table->enum('it',['Belum Diperiksa', 'Sedang Diperbaiki', 'Rusak', 'Sudah Diperbaiki'])->default('Belum Diperiksa');

            // Relasi ke tabel gedung
            $table->foreignId('id_gedung')
                  ->constrained('gedung')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // Relasi ke tabel users (siapa yang melakukan inspeksi)
            $table->foreignId('id_user')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->enum('status_keseluruhan_inspeksi', ['Terbuka', 'Selesai'])->default('Terbuka');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspeksi_gedung');
    }
};
