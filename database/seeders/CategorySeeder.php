<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['name' => 'Inverters', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Batteries', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
