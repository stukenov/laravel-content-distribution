<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Whats New',
        ]);
        Category::create([
            'name' => 'Tv Series',
        ]);
        Category::create([
            'name' => 'Documentaries',
        ]);
        Category::create([
            'name' => 'For Kids',
        ]);
        Category::create([
            'name' => 'Other',
        ]);
    }
}
