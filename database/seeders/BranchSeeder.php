<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::insert([
            ['name' => 'HQ', 'location' => 'Bandar Baru Bangi'],
            ['name' => 'Branch SA', 'location' => 'Shah Alam'],
            ['name' => 'Branch GB', 'location' => 'Gombak'],
        ]);
    }
}
