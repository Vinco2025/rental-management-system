<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Basic Info
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->text('address');
            $table->date('birthdate');
            $table->enum('gender', ['male', 'female', 'other']);

            // Emergency Info
            $table->string('emergency_name');
            $table->string('emergency_phone');
            $table->string('emergency_relationship');

            // ID DOcument
            $table->string('id_type');
            $table->string('id_number');

            // Tenancy Info
            $table->date('move_in_date');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
