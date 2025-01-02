<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $leader = Position::create([
            'name' => 'Leader',
            'level' => 1,
            'parent_id' => null,
        ]);

        $manager = Position::create([
            'name' => 'Manager',
            'level' => 2,
            'parent_id' => $leader->id,
        ]);

        Position::create([
            'name' => 'Officer 1',
            'level' => 3,
            'parent_id' => $manager->id,
        ]);

        Position::create([
            'name' => 'Officer 2',
            'level' => 3,
            'parent_id' => $manager->id,
        ]);
    }
}
