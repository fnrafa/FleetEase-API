<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    public function run(): void
    {
        Driver::create([
            'name' => 'Driver 1',
            'license_number' => 'DRV123456',
            'contact_number' => '08123456789',
        ]);

        Driver::create([
            'name' => 'Driver 2',
            'license_number' => 'DRV654321',
            'contact_number' => '08198765432',
        ]);
    }
}
