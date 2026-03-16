@extends('layouts.app')

@section('title', $post->title)
@section('meta_description', $post->excerpt)
@section('og_image', $post->featured_image_url)

@section('content')
<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Header -->
    <header class="mb-8">
        <div class="flex gap-2 text-sm text-gray-500 mb-4">
            @foreach($post->categories as $category)
            <a href="{{ route('posts.index', ['category' => $category->slug]) }}"
               class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition">
                {{ $category->name }}
            </a>
            @endforeach
        </div>

        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center space-x-4">
                <img src="{{ $post->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}"
                     alt="{{ $post->user->name }}" class="w-12 h-12 rounded-full">
                <div>
                    <p class="font-semibold text-gray-900">{{ $post->user->name }}</p>
                    <div class="flex items-center text-sm text-gray-500 gap-2">
                        <span>{{ $post->published_at?->format('M d, Y') ?? 'Draft preview' }}</span>
                        <span>•</span>
                        <span>{{ $post->reading_time ?? 1 }} min read</span>
                        <span>•</span>
                        <span>{{ number_format($post->views ?? 0) }} views</span>
                    </div>
                </div>
            </div>

            @auth
                @if(Auth::id() === $post->user_id || (method_exists(Auth::user(), 'isAdmin') ? Auth::user()->isAdmin() : (Auth::user()->is_admin ?? false)))
                <div class="flex gap-2">
                    <a href="{{ route('posts.edit', $post->id) }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                          onsubmit="return confirm('Delete this post?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Delete</button>
                    </form>
                </div>
                @endif
            @endauth
        </div>

        @if(!$post->is_published)
        <div class="mt-4 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-100 text-amber-700">
            Draft preview
        </div>
        @endif
    </header>

    <!-- Featured Image -->
    @if($post->featured_image)
    <div class="mb-8">
        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
             class="w-full rounded-xl shadow-lg">
    </div>
    @endif

    <!-- Content -->
    <div class="prose prose-lg max-w-none mb-12">{!! nl2br(e($post->body)) !!}</div>

    <!-- Tags -->
    @if($post->tags->count())
    <div class="border-t border-gray-200 pt-8 mb-8">
        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Tags</h3>
        <div class="flex flex-wrap gap-2">
            @foreach($post->tags as $tag)
            <a href="{{ route('posts.index', ['tag' => $tag->slug]) }}"
               class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-gray-200 transition">
                #{{ $tag->name }}
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Author Bio -->
    <div class="bg-gray-50 rounded-xl p-8 mb-12">
        <div class="flex items-start gap-4">
            <img src="{{ $post->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}"
                 alt="{{ $post->user->name }}" class="w-16 h-16 rounded-full">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Written by {{ $post->user->name }}</h3>
                @if($post->user->bio)
                <p class="text-gray-600 mb-3">{{ $post->user->bio }}</p>
                @endif
                <div class="flex gap-4">
                    @if($post->user->website)
                    <a href="{{ $post->user->website }}" target="_blank" class="text-gray-500 hover:text-gray-700">Website</a>
                    @endif
                    @if($post->user->twitter)
                    <a href="https://twitter.com/{{ $post->user->twitter }}" target="_blank" class="text-gray-500 hover:text-gray-700">Twitter</a>
                    @endif
                    @if($post->user->github)
                    <a href="https://github.com/{{ $post->user->github }}" target="_blank" class="text-gray-500 hover:text-gray-700">GitHub</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Comments -->
    <div class="border-t border-gray-200 pt-12">
        <h3 class="text-2xl font-bold text-gray-900 mb-8">Comments ({{ $post->comments->count() }})</h3>

        @auth
        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-8">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Add a comment</label>
                <textarea name="content" rows="3" required
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
            </div>
            <button type="submit" class="px-6 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition">Post Comment</button>
        </form>
        @else
        <div class="bg-gray-50 rounded-lg p-6 text-center mb-8">
            <p class="text-gray-600 mb-4">Please <a href="{{ route('login') }}" class="text-blue-600 hover:underline">login</a> to leave a comment.</p>
        </div>
        @endauth

        <div class="space-y-6">
            @forelse($post->comments as $comment)
            <div class="border-b border-gray-200 pb-6 last:border-0">
                <div class="flex gap-4">
                    <img src="{{ $comment->user?->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($comment->name) }}"
                         alt="{{ $comment->name }}" class="w-10 h-10 rounded-full">
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-semibold text-gray-900">{{ $comment->name }}</span>
                            <span class="text-sm text-gray-500">{{ $comment->created_at?->diffForHumans() ?? 'Just now' }}</span>
                        </div>
                        <p class="text-gray-700">{{ $comment->content }}</p>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-center py-8">No comments yet. Be the first to comment!</p>
            @endforelse
        </div>
    </div>
</article>

<!-- Related Posts -->
@if($relatedPosts->count())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-gray-50">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900">Related Articles</h2>
        <p class="text-gray-600 mt-2">You might also enjoy these posts</p>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        @foreach($relatedPosts as $related)
        <article class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition group">
            @if($related->featured_image)
            <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}"
                 class="w-full h-48 object-cover group-hover:scale-105 transition duration-500">
            @endif
            <div class="p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-2">
                    <a href="{{ route('posts.show', $related->slug) }}" class="hover:text-blue-600">{{ $related->title }}</a>
                </h3>
                <p class="text-gray-600 text-sm mb-4">{{ \Illuminate\Support\Str::limit($related->excerpt, 100) }}</p>
                <div class="flex items-center justify-between text-sm text-gray-500">
                    <span>{{ $related->published_at?->diffForHumans() ?? 'Draft' }}</span>
                    <span>{{ $related->reading_time ?? 1 }} min read</span>
                </div>
            </div>
        </article>
        @endforeach
    </div>
</section>
@endif
@endsection