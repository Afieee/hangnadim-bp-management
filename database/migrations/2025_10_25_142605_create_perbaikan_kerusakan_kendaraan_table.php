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
        Schema::create('perbaikan_kerusakan_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->text('catatan_perbaikan');
            $table->string('file_bukti_perbaikan');
            $table->foreignId('id_kerusakan_kendaraan')
                ->constrained('kerusakan_kendaraan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('perbaikan_kerusakan_kendaraan');
    }
};
