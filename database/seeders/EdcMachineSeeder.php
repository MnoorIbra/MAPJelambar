<?php

namespace Database\Seeders;

use App\Models\EdcMachine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EdcMachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        EdcMachine::create([
                'name' => 'EDC Toko Maju',
                'serial_number' => 'EDC-001',
                'address' => 'Jl. Merdeka No. 1, Jakarta Pusat',
                'latitude' => -6.1754,
                'longitude' => 106.8272,
                'status' => 'already exist',
                'user_id' => 1,
            ]);
            EdcMachine::create([
                'name' => 'EDC Bank ABC',
                'serial_number' => 'EDC-002',
                'address' => 'Jl. Sudirman No. 10, Jakarta Selatan',
                'latitude' => -6.2215,
                'longitude' => 106.8140,
                'status' => 'not exist',
                'user_id' => 1,
            ]);
    }
}
