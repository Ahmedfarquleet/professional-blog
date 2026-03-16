<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology', 'color' => '#3B82F6', 'description' => 'Latest in tech and innovation'],
            ['name' => 'Lifestyle', 'color' => '#10B981', 'description' => 'Health, wellness, and daily living'],
            ['name' => 'Travel', 'color' => '#F59E0B', 'description' => 'Adventures and travel guides'],
            ['name' => 'Food', 'color' => '#EF4444', 'description' => 'Recipes and culinary experiences'],
            ['name' => 'Business', 'color' => '#8B5CF6', 'description' => 'Entrepreneurship and finance'],
            ['name' => 'Design', 'color' => '#EC4899', 'description' => 'UI/UX and creative design'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'color' => $category['color'],
                'description' => $category['description'],
            ]);
        }
    }
}