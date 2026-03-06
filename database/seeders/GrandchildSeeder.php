<?php

namespace Database\Seeders;

use App\Models\Grandchild;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrandchildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ongrid_inverters = Subcategory::where('name', 'Ongrid Inverters')->first();
        $hybrid_inverters = Subcategory::where('name', 'Hybrid Inverters')->first();


        Grandchild::insert([
            [
                'subcategory_id' => $ongrid_inverters->id,
                'name' => '1 Phase',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subcategory_id' => $ongrid_inverters->id,
                'name' => '3 Phase',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subcategory_id' => $hybrid_inverters->id,
                'name' => '1 Phase',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subcategory_id' => $hybrid_inverters->id,
                'name' => '3 Phase Low Voltage',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subcategory_id' => $hybrid_inverters->id,
                'name' => '3 Phase High Voltage',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
