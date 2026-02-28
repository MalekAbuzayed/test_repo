<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategorySeeder extends Seeder
{
    public function run(): void
    {
        $inverters = Category::where('name', 'Inverters')->first();
        $batteries = Category::where('name', 'Batteries')->first();

        Subcategory::insert([
            // Inverters
            [
                'category_id' => $inverters->id,
                'name' => 'Ongrid Inverters',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $inverters->id,
                'name' => 'Hybrid Inverters',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Batteries
            [
                'category_id' => $batteries->id,
                'name' => 'LV Batteries',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $batteries->id,
                'name' => 'HV Batteries',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
