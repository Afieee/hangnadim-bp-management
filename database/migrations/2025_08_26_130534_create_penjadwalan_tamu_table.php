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
        Schema::create('penjadwalan_tamu', function (Blueprint $table) {
            $table->id();
            $table->enum('level_tamu', ['Kepresidenan', 'Kementerian', 'Lembaga Negara' , 'Tamu Negara', 'Instansi Lain'])
                    ->default('Instansi Lain');

            $table->string('subjek_tamu');
            $table->string('instansi');


            $table->timestamp('waktu_tamu_berangkat')
                    ->nullable()
                    ->comment('Waktu tamu berangkat dari bandara sebelumnya');

            $table->timestamp('waktu_tamu_mendarat')
                    ->nullable()
                    ->comment('Waktu tamu mendarat di bandara tujuan');

            $table->string('kode_penerbangan')->nullable();
            $table->string('kode_bandara_asal')->nullable();
            $table->string('lembar_disposisi')->nullable();

            $table->foreignId('id_gedung')
                    ->constrained('gedung')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreignId('id_user')
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
        Schema::dropIfExists('penjadwalan_tamu');
    }
};
