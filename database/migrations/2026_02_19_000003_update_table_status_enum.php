<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        $prefix = Schema::getConnection()->getTablePrefix();
        $table = $prefix . 'restaurant_tables';
        DB::statement("ALTER TABLE `{$table}` MODIFY `status` ENUM('available','booked','occupied') NOT NULL DEFAULT 'available'");
    }
    public function down(): void {
        $prefix = Schema::getConnection()->getTablePrefix();
        $table = $prefix . 'restaurant_tables';
        DB::statement("ALTER TABLE `{$table}` MODIFY `status` ENUM('available','occupied') NOT NULL DEFAULT 'available'");
    }
};
