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
        Schema::create('backup_feedback', function (Blueprint $table) {
            $table->id();
            $table->text('catatan_feedback')->nullable();
            $table->string('perwakilan_atau_pengisi');
            $table->string('indeks_rating_pelayanan')->required();
            $table->string('mutu_rating_pelayanan');
            $table->string('predikat_rating_pelayanan');
            $table->foreignId('id_feedback')
                  ->constrained('feedback')
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
        Schema::dropIfExists('backup_feedback');
    }
};
