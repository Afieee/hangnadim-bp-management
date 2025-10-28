<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        // Tambahkan dua role baru ke dalam enum
        DB::statement("
            ALTER TABLE `users`
            MODIFY `role` ENUM(
                'Admin',
                'Kepala Seksi',
                'Staff Pelaksana',
                'Direktur',
                'Kepala Sub Direktorat',
                'Deputi',
                'Tata Usaha',
                'IT',
                'Pengelola Asset',
                'Staff Pelaksana Asset'
            ) AFTER `email`
        ");
    }

    /**
     * Rollback migrasi (kembali ke role sebelumnya).
     */
    public function down(): void
    {
        // Kembalikan ke enum lama tanpa dua role baru
        DB::statement("
            ALTER TABLE `users`
            MODIFY `role` ENUM(
                'Admin',
                'Kepala Seksi',
                'Staff Pelaksana',
                'Direktur',
                'Kepala Sub Direktorat',
                'Deputi',
                'Tata Usaha',
                'IT'
            ) AFTER `email`
        ");
    }
};
