<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        // FIXED: SQLite compatible query
        $tags = Tag::withCount(['posts' => function($query) {
                $query->where('is_published', true);
            }])
            ->get()
            ->filter(function($tag) {
                return $tag->posts_count > 0;
            })
            ->sortByDesc('posts_count');

        return view('tags.index', compact('tags'));
    }

    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        
        $posts = Post::with('user', 'categories', 'tags')
            ->where('is_published', true)
            ->whereHas('tags', function($q) use ($tag) {
                $q->where('tags.id', $tag->id);
            })
            ->latest('published_at')
            ->paginate(9);

        return view('tags.show', compact('tag', 'posts'));
    }
}