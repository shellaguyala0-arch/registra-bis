<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Barangay Treasurer',
            'username' => 'treasurer',
            'password' => 'password',
            'role' => 'treasurer',
        ]);

  
        User::create([
            'name' => 'Barangay Secretary',
            'username' => 'secretary',
            'password' => 'password',
            'role' => 'secretary',
        ]);


        User::create([
            'name' => 'Barangay Captain',
            'username' => 'captain',
            'password' => 'password',
            'role' => 'captain',
        ]);
    }
}