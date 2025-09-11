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
            $table->enum('furniture', ['Belum Diperiksa', 'Baik', 'Sedang Diperbaiki', 'Rusak', 'Sudah Diperbaiki'])->default('Belum Diperiksa');
            $table->enum('fire_system',  ['Belum Diperiksa', 'Baik', 'Sedang Diperbaiki', 'Rusak', 'Sudah Diperbaiki'])->default('Belum Diperiksa');
            $table->enum('gedung_dan_bangunan',  ['Belum Diperiksa', 'Baik', 'Sedang Diperbaiki', 'Rusak', 'Sudah Diperbaiki'])->default('Belum Diperiksa');
            $table->enum('mekanikal_elektrikal',  ['Belum Diperiksa', 'Baik', 'Sedang Diperbaiki', 'Rusak', 'Sudah Diperbaiki'])->default('Belum Diperiksa');
            $table->enum('it',['Belum Diperiksa', 'Baik' , 'Sedang Diperbaiki', 'Rusak', 'Sudah Diperbaiki'])->default('Belum Diperiksa');
            $table->enum('jalan_dan_jembatan',  ['Belum Diperiksa', 'Baik', 'Sedang Diperbaiki', 'Rusak', 'Sudah Diperbaiki'])->default('Belum Diperiksa');
            $table->enum('jaringan_air',  ['Belum Diperiksa', 'Baik', 'Sedang Diperbaiki', 'Rusak', 'Sudah Diperbaiki'])->default('Belum Diperiksa');
            $table->enum('drainase',  ['Belum Diperiksa', 'Baik', 'Sedang Diperbaiki', 'Rusak', 'Sudah Diperbaiki'])->default('Belum Diperiksa');

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
