<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('restaurant_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade');
            $table->string('name'); // Table number/name
            $table->unsignedInteger('capacity')->default(2);
            $table->enum('status', ['available', 'occupied'])->default('available')->index();
            $table->timestamps();
            $table->unique(['restaurant_id', 'name']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('restaurant_tables');
    }
};
