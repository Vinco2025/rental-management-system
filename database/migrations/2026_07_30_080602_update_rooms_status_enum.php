<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE rooms MODIFY COLUMN status ENUM('available', 'occupied', 'under_maintenance', 'reserved') NOT NULL DEFAULT 'available'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE rooms MODIFY COLUMN status ENUM('vacant', 'occupied', 'under_maintenance', 'reserved') NOT NULL DEFAULT 'vacant'");
    }
};
