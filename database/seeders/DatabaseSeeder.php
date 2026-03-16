<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'is_admin' => true,
                'bio' => 'Blog administrator and tech enthusiast',
            ]
        );

        $this->call([
            CategorySeeder::class,
        ]);

        $categories = Category::all();

        if ($categories->isEmpty()) {
            return;
        }

        for ($i = 1; $i <= 12; $i++) {
            $title = "Sample Post Title {$i} " . fake()->sentence(3);

            $post = Post::create([
                'user_id' => $admin->id,
                'title' => $title,
                'slug' => Str::slug($title . '-' . $i),
                'excerpt' => "This is a brief excerpt for post {$i}. " . fake()->sentence(12),
                'body' => implode("\n\n", fake()->paragraphs(5)),
                'reading_time' => rand(3, 10),
                'views' => rand(10, 1000),
                'is_published' => true,
                'published_at' => now()->subDays(rand(0, 30)),
                'meta_data' => [
                    'title' => $title,
                    'description' => "SEO description for post {$i}",
                ],
            ]);

            $post->categories()->attach(
                $categories->random(rand(1, min(3, $categories->count())))->pluck('id')->toArray()
            );
        }
    }
}