<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique();
            $table->integer('floor');
            $table->foreignId('room_type_id')->constrained()->cascadeOnDelete();
            $table->decimal('monthly_rate', 8, 2);
            $table->enum('status', ['vacant', 'occupied', 'under_maintenance', 'reserved'])->default('vacant');
            $table->integer('max_occupants');
            $table->text('amenities')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
