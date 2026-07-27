<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name'              => 'Admin',
            'email'             => 'admin@rental.com',
            'password'          => Hash::make('Admin1234!'),
            'email_verified_at' => now(),
        ]);

        $admin->assignRole('admin');
    }
}