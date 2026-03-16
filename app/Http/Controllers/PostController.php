<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function home()
    {
        $featuredPost = Post::with('user', 'categories')
            ->where('is_published', true)
            ->latest('published_at')
            ->first();

        $latestPosts = Post::with('user', 'categories')
            ->where('is_published', true)
            ->latest('published_at')
            ->take(6)
            ->get();

        $popularPosts = Post::with('user')
            ->where('is_published', true)
            ->orderBy('views', 'desc')
            ->take(3)
            ->get();

        $categories = Category::withCount(['posts' => function ($query) {
                $query->where('is_published', true);
            }])
            ->get()
            ->filter(function ($category) {
                return $category->posts_count > 0;
            })
            ->sortByDesc('posts_count')
            ->take(6);

        return view('home', compact('featuredPost', 'latestPosts', 'popularPosts', 'categories'));
    }

    public function index(Request $request)
    {
        $query = Post::with('user', 'categories', 'tags')
            ->where('is_published', true);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        $posts = $query->latest('published_at')->paginate(9);

        $categories = Category::withCount(['posts' => function ($query) {
                $query->where('is_published', true);
            }])
            ->get()
            ->filter(function ($category) {
                return $category->posts_count > 0;
            });

        $popularTags = Tag::withCount(['posts' => function ($query) {
                $query->where('is_published', true);
            }])
            ->get()
            ->filter(function ($tag) {
                return $tag->posts_count > 0;
            })
            ->sortByDesc('posts_count')
            ->take(10);

        return view('posts.index', compact('posts', 'categories', 'popularTags'));
    }

    public function show($slug)
    {
        $post = Post::with('user', 'categories', 'tags', 'comments.user')
            ->where('slug', $slug)
            ->firstOrFail();

        // Allow published posts for everyone
        // Allow draft preview only for owner or admin
        if (!$post->is_published) {
            if (!Auth::check() || (Auth::id() !== $post->user_id && !Auth::user()->is_admin)) {
                abort(404);
            }
        }

        // Increase views only for published posts
        if ($post->is_published) {
            $post->increment('views');
        }

        $relatedPosts = Post::with('user', 'categories')
            ->where('is_published', true)
            ->where('id', '!=', $post->id)
            ->whereHas('categories', function ($q) use ($post) {
                $q->whereIn('categories.id', $post->categories->pluck('id'));
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    public function dashboard()
    {
        $user = Auth::user();

        $posts = Post::where('user_id', $user->id)
            ->with('categories')
            ->latest()
            ->paginate(10);

        $totalPosts = Post::where('user_id', $user->id)->count();
        $publishedPosts = Post::where('user_id', $user->id)->where('is_published', true)->count();
        $totalViews = Post::where('user_id', $user->id)->sum('views');

        $postIds = Post::where('user_id', $user->id)->pluck('id');
        $totalComments = Comment::whereIn('post_id', $postIds)->count();

        $stats = [
            'total_posts' => $totalPosts,
            'published_posts' => $publishedPosts,
            'total_views' => $totalViews,
            'total_comments' => $totalComments,
        ];

        return view('dashboard', compact('posts', 'stats'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $slug = Str::slug($request->title);
        $count = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->title) . '-' . $count++;
        }

        $featuredImage = null;
        if ($request->hasFile('featured_image')) {
            $featuredImage = $request->file('featured_image')->store('posts', 'public');
        }

        $wordCount = str_word_count(strip_tags($request->body));
        $readingTime = max(1, ceil($wordCount / 200));

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => $slug,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'featured_image' => $featuredImage,
            'reading_time' => $readingTime,
            'views' => 0,
            'is_published' => $request->has('is_published') ? 1 : 0,
            'published_at' => $request->has('is_published') ? now() : null,
        ]);

        $post->categories()->sync($request->categories ?? []);
        $post->tags()->sync($request->tags ?? []);

        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($post->title !== $request->title) {
            $slug = Str::slug($request->title);
            $count = 1;

            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = Str::slug($request->title) . '-' . $count++;
            }

            $post->slug = $slug;
        }

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }

            $post->featured_image = $request->file('featured_image')->store('posts', 'public');
        }

        $wordCount = str_word_count(strip_tags($request->body));
        $post->reading_time = max(1, ceil($wordCount / 200));

        $post->title = $request->title;
        $post->excerpt = $request->excerpt;
        $post->body = $request->body;
        $post->is_published = $request->has('is_published') ? 1 : 0;

        if ($request->has('is_published')) {
            if (!$post->published_at) {
                $post->published_at = now();
            }
        } else {
            $post->published_at = null;
        }

        $post->save();

        $post->categories()->sync($request->categories ?? []);
        $post->tags()->sync($request->tags ?? []);

        return redirect()->route('dashboard')->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        Comment::where('post_id', $post->id)->delete();
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully!');
    }
}