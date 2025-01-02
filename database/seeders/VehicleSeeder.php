<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        Vehicle::create([
            'license_plate' => 'B1234XYZ',
            'type' => 'passenger',
            'ownership' => 'company',
            'rental_company' => null,
            'fuel_efficiency' => '12km/l',
            'next_service_date' => '2025-03-01',
        ]);

        Vehicle::create([
            'license_plate' => 'B5678XYZ',
            'type' => 'cargo',
            'ownership' => 'rental',
            'rental_company' => 'Rental Co.',
            'fuel_efficiency' => '8km/l',
            'next_service_date' => '2025-04-15',
        ]);
    }
}
