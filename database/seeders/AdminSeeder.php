<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/AdminSeeder.php
public function run(): void
{
    \App\Models\User::firstOrCreate(
        ['email' => 'admin@medicare.com'],
        [
            'name'     => 'Admin',
            'password' => bcrypt('Admin@1234'),
            'role'     => 'admin',
        ]
    );
}
}
