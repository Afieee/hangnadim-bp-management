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
        Schema::create('bukti_perbaikan', function (Blueprint $table) {
            $table->id();

            $table->string('judul_bukti_kerusakan');
            $table->text('deskripsi_bukti_kerusakan');
            $table->enum('tipe_kerusakan',['Furniture', 'Fire System', 'Bangunan', 'Mekanikal Elektrikal', 'IT']);

            $table->string('file_bukti_kerusakan')->nullable();

            // Kolom untuk menyimpan bukti kerusakan
            $table->foreignId('id_inspeksi_gedung')
                  ->constrained('inspeksi_gedung')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            // Relasi ke tabel inspeksi_gedung
            $table->foreignId('id_user_inspektor')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_perbaikan');
    }
};
