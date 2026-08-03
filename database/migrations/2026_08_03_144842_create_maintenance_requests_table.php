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
    Schema::create('maintenance_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
        $table->foreignId('room_id')->constrained()->cascadeOnDelete();
        $table->string('title');
        $table->text('description');
        $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('low');
        $table->enum('status', ['pending', 'in_progress', 'resolved'])->default('pending');
        $table->enum('submitted_by', ['admin', 'tenant'])->default('tenant');
        $table->text('resolution_notes')->nullable();
        $table->timestamp('resolved_at')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_requests');
    }
};
