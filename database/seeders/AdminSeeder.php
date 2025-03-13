<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Support\Facades\Hash;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'name' => 'admin1',
            'prenom' => 'super',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        
        Client::create([
            'name' => 'Admin2',
            'prenom' => 'Manager',
            'email' => 'admin2@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        
    }
}
