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
    Schema::create('panels', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('serial_number')->unique();
    $table->decimal('power_capacity', 8, 2);
    $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('zone_id')->nullable()->constrained()->onDelete('set null');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panels');
    }
};
