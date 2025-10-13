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
        Schema::table('kendaraan', function (Blueprint $table) {
            $table->string('km')->nullable()->after('pajak_berlaku_hingga');
            $table->date('waktu_diservice_terakhir')->nullable()->after('km');
            $table->date('waktu_diservice_selanjutnya')->nullable()->after('waktu_diservice_terakhir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kendaraan', function (Blueprint $table) {
            $table->dropColumn(['km', 'waktu_diservice_terakhir', 'waktu_diservice_selanjutnya']);
        });
    }
};
