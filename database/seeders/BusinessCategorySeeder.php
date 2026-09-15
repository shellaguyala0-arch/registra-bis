<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BusinessCategory;

class BusinessCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Sari-sari Store',
            'Eatery',
            'Hardware',
            'Bakery',
            'Retail',
            'Services',
        ];

        foreach ($categories as $category) {
            BusinessCategory::firstOrCreate([
                'name' => $category,
            ]);
        }
    }
}