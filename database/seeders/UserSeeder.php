<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'johndoe',
            'name' => 'John Doe',
            'nis' => 12345678,
            'rayon' => 'Rayon A',
            'romble' => 'XI RPL 1',
            'password' => Hash::make('password123'),
            'photo_profile' => null
        ]);

        User::create([
            'username' => 'sayyidberryl',
            'name' => 'Sayyid Berryl M',
            'nis' => 12310041,
            'rayon' => 'Cic 8',
            'romble' => 'PPLG XII-4',
            'password' => Hash::make('password123'),
            'photo_profile' => null
        ]);
    }
}