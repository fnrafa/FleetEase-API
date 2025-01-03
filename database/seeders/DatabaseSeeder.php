<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PositionSeeder::class,
            UserSeeder::class,
            DriverSeeder::class,
            VehicleSeeder::class,
        ]);
    }
}
