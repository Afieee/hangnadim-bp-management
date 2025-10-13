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
        Schema::create('histori_service_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('km')->nullable();
            $table->date('waktu_diservice_terakhir')->nullable();
            $table->date('waktu_diservice_selanjutnya')->nullable();

            $table->foreignId('id_user')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('id_kendaraan')
                ->constrained('kendaraan')
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
        Schema::dropIfExists('histori_service_kendaraan');
    }
};
