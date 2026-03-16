<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $user = User::create([
                'name' => 'Ahmed',
                'email' => 'ahmed@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        $posts = [
            [
                'title' => 'How Modern Web Design Improves User Experience',
                'category' => 'Design',
                'excerpt' => 'Discover how thoughtful spacing, typography, and visual hierarchy can transform an ordinary website.',
                'content' => 'Modern web design improves readability, usability, and trust.',
            ],
            [
                'title' => 'Top Laravel Tips for Building Faster Applications',
                'category' => 'Technology',
                'excerpt' => 'Learn practical Laravel techniques that help organize code and improve performance.',
                'content' => 'Laravel offers elegant tools for routing, Eloquent, queues, caching, and more.',
            ],
            [
                'title' => 'Designing a Blog Homepage That Feels Professional',
                'category' => 'Design',
                'excerpt' => 'A strong homepage should guide visitors clearly and highlight featured content.',
                'content' => 'A good homepage uses layout, spacing, and hierarchy to improve first impressions.',
            ],
            [
                'title' => 'The Future of Frontend Development in 2025',
                'category' => 'Technology',
                'excerpt' => 'Frontend development continues to evolve with better tools and interactive experiences.',
                'content' => 'Modern frontend stacks focus on speed, accessibility, and better user experiences.',
            ],
            [
                'title' => 'Simple Ways to Make Your Dashboard Look Premium',
                'category' => 'Lifestyle',
                'excerpt' => 'Small upgrades like cleaner cards and better spacing can improve dashboard UI.',
                'content' => 'A premium dashboard needs clear layout, color balance, and intuitive navigation.',
            ],
            [
                'title' => 'Why Clean UI Matters for Content-Driven Websites',
                'category' => 'Design',
                'excerpt' => 'A clean and readable interface helps users focus on content and navigate faster.',
                'content' => 'Clean UI builds trust and keeps users engaged for longer reading sessions.',
            ],
        ];

        foreach ($posts as $item) {
            $post = Post::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'excerpt' => $item['excerpt'],
                'content' => $item['content'],
                'is_published' => true,
                'published_at' => now(),
                'user_id' => $user->id,
            ]);

            $category = Category::where('name', $item['category'])->first();

            if ($category) {
                $post->categories()->attach($category->id);
            }
        }
    }
}