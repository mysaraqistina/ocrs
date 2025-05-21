<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'branch_id' => 1, // Replace with a valid branch_id from your branches table
            'name' => 'HQ - Bandar Baru Bangi',
            'email' => 'adminbbb@example.com',
            'password' => Hash::make('123'), // Securely hashed password
        ]);

        Admin::create([
            'branch_id' => 2, // Replace with a valid branch_id from your branches table
            'name' => 'Branch - Shah Alam',
            'email' => 'adminsa@example.com',
            'password' => Hash::make('123'), // Securely hashed password
        ]);

        Admin::create([
            'branch_id' => 3, // Replace with a valid branch_id from your branches table
            'name' => 'Branch - Gombak',
            'email' => 'admingombak@example.com',
            'password' => Hash::make('123'), // Securely hashed password
        ]);
    }
}
