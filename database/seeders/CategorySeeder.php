<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Business',
            ],
            [
                'name' => 'Lifestyle',
            ],
            [
                'name' => 'Travel',
            ],
            [
                'name' => 'MMA'
            ],
            [
                'name' => 'Software'
            ],
            [
                'name' => 'Cooking'
            ]
        ]);

    }
}
