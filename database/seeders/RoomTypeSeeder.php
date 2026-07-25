<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomType;

class RoomTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Single',  'description' => 'Good for 1 occupant only.',       'max_occupants' => 1],
            ['name' => 'Double',  'description' => 'Shared room for 2 occupants.',     'max_occupants' => 2],
            ['name' => 'Studio',  'description' => 'Self-contained room with ensuite.','max_occupants' => 1],
            ['name' => 'Bedspace','description' => 'Shared dormitory-style bedspace.',  'max_occupants' => 6],
        ];

        foreach ($types as $type) {
            RoomType::firstOrCreate(['name' => $type['name']], $type);
        }
    }
}