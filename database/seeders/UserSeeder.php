<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $positions = Position::pluck('id', 'name');

        User::create([
            'name' => 'Admin',
            'email' => 'admin@fnrafa.my.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'position_id' => null,
        ]);

        User::create([
            'name' => 'Leader',
            'email' => 'leader@fnrafa.my.id',
            'password' => Hash::make('password123'),
            'role' => 'approver',
            'position_id' => $positions['Leader'],
        ]);

        User::create([
            'name' => 'Manager',
            'email' => 'manager@fnrafa.my.id',
            'password' => Hash::make('password123'),
            'role' => 'approver',
            'position_id' => $positions['Manager'],
        ]);

        User::create([
            'name' => 'Officer 1',
            'email' => 'officer1@fnrafa.my.id',
            'password' => Hash::make('password123'),
            'role' => 'approver',
            'position_id' => $positions['Officer 1'],
        ]);

        User::create([
            'name' => 'Officer 2',
            'email' => 'officer2@fnrafa.my.id',
            'password' => Hash::make('password123'),
            'role' => 'approver',
            'position_id' => $positions['Officer 2'],
        ]);
    }
}
