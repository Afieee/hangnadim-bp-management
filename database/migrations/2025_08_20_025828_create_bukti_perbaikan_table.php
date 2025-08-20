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

            $table->text('catatan_bukti_perbaikan');

            $table->string('file_bukti_perbaikan')->nullable();
            // Kolom untuk menyimpan bukti kerusakan
            $table->foreignId('id_bukti_kerusakan')
                  ->constrained('bukti_kerusakan')
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
