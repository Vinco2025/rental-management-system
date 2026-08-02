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
    Schema::create('bills', function (Blueprint $table) {
        $table->id();
        $table->foreignId('lease_contract_id')->constrained()->cascadeOnDelete();
        $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
        $table->date('billing_month'); // stored as first day of the month, e.g. 2025-06-01
        $table->decimal('rent_amount', 10, 2)->default(0);
        $table->decimal('electricity_amount', 10, 2)->default(0);
        $table->decimal('water_amount', 10, 2)->default(0);
        $table->decimal('total_amount', 10, 2)->default(0);
        $table->decimal('amount_paid', 10, 2)->default(0);
        $table->decimal('balance', 10, 2)->default(0);
        $table->enum('status', ['unpaid', 'partial', 'paid'])->default('unpaid');
        $table->date('due_date');
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
