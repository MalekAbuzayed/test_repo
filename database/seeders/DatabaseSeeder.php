<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AboutUsSeeder::class,
            AdminSeeder::class,
            ContactUsRequestSeeder::class,
            ContactUsSeeder::class,
            TermsSeeder::class,
            SliderSeeder::class,
            PrivacySeeder::class,
            CategorySeeder::class,
            SubcategorySeeder::class,
            SpecTemplateSeeder::class,
        ]);
    }
}
