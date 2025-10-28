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
        Schema::create('kerusakan_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('objek_kerusakan');
            $table->string('tipe_kerusakan');
            $table->text('deskripsi_kerusakan');
            $table->string('foto_kerusakan');
            $table->string('status_kerusakan');

            $table->foreignId('id_kendaraan')
                ->constrained('kendaraan')
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
        Schema::dropIfExists('kerusakan_kendaraan');
    }
};
