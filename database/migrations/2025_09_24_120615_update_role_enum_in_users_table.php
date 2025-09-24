<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update enum dengan menambahkan IT
        DB::statement("ALTER TABLE `users` MODIFY `role` ENUM('Admin','Kepala Seksi','Staff Pelaksana','Direktur','Kepala Sub Direktorat','Deputi','Tata Usaha','IT') AFTER `email`");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Balik lagi ke enum sebelumnya tanpa IT
        DB::statement("ALTER TABLE `users` MODIFY `role` ENUM('Admin','Kepala Seksi','Staff Pelaksana','Direktur','Kepala Sub Direktorat','Deputi','Tata Usaha') AFTER `email`");
    }
};
