<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $prefix = Schema::getConnection()->getTablePrefix();
        $table = $prefix . 'orders';
        DB::statement("ALTER TABLE {$table} MODIFY COLUMN status ENUM('pending','confirmed','preparing','ready','approved','delivered','cancelled') NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        $prefix = Schema::getConnection()->getTablePrefix();
        $table = $prefix . 'orders';
        DB::statement("ALTER TABLE {$table} MODIFY COLUMN status ENUM('pending','confirmed','preparing','ready','delivered','cancelled') NOT NULL DEFAULT 'pending'");
    }
};
