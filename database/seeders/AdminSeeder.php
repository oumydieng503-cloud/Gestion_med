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
    \App\Models\User::create([
        'name'     => 'Admin',
        'email'    => 'admin@medicare.com',
        'password' => bcrypt('password123'),
        'role'     => 'admin',
    ]);
}
}
