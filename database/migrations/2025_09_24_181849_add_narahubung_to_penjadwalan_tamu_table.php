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
        Schema::table('penjadwalan_tamu', function (Blueprint $table) {
            $table->string('narahubung_pihak_tamu')->nullable()->after('lembar_disposisi');
            $table->string('no_handphone_narahubung')->nullable()->after('narahubung_pihak_tamu');
            $table->string('email_narahubung')->nullable()->after('no_handphone_narahubung');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjadwalan_tamu', function (Blueprint $table) {
            $table->dropColumn(['narahubung_pihak_tamu', 'no_handphone_narahubung', 'email_narahubung']);
        });
    }
};
