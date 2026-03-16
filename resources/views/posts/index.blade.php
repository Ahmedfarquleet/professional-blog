@extends('layouts.app')

@section('title', 'All Articles')
@section('meta_description', 'Browse all articles on our blog')

@section('content')
@php
    $sampleImages = [
        'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1484417894907-623942c8ee29?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1200&q=80',
    ];

    $sampleTitles = [
        'How Modern Web Design Improves User Experience',
        'Top Laravel Tips for Building Faster Applications',
        'Designing a Blog Homepage That Feels Professional',
        'The Future of Frontend Development in 2025',
        'Simple Ways to Make Your Dashboard Look Premium',
        'Why Clean UI Matters for Content-Driven Websites',
    ];

    $sampleExcerpts = [
        'Discover how thoughtful spacing, typography, and visual hierarchy can transform an ordinary website into an engaging digital experience that keeps readers interested.',
        'Learn practical Laravel techniques that help you organize code better, improve performance, and build applications that feel smooth and reliable.',
        'A strong homepage is more than just layout. It should guide visitors clearly, highlight featured content, and create a memorable first impression.',
        'Frontend development continues to evolve with better tools, faster workflows, and more interactive experiences that make websites feel modern and intuitive.',
        'Small upgrades like cleaner cards, stronger section spacing, and better image choices can instantly make your admin dashboard feel polished.',
        'A clean and readable interface helps users focus on the content, navigate faster, and trust your platform more from the very first visit.',
    ];

    $sampleCategories = ['Technology', 'Design', 'Development', 'UI/UX', 'Productivity', 'Lifestyle'];
@endphp

<section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-purple-950 to-violet-950">
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-72 h-72 bg-purple-400 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute top-10 right-0 w-72 h-72 bg-pink-400 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 left-1/3 w-72 h-72 bg-indigo-400 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-24">
        <div class="max-w-3xl mx-auto text-center">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/15 text-white/90 text-sm font-semibold uppercase tracking-[0.2em]">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Articles
            </span>

            <h1 class="mt-6 text-4xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-tight">
                All Articles
            </h1>

            <p class="mt-5 text-lg sm:text-xl text-slate-300 leading-8 max-w-2xl mx-auto">
                Discover stories, thinking, and expertise from writers on any topic.
            </p>
        </div>
    </div>
</section>

<section class="bg-slate-50 py-12 sm:py-16 min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Search -->
        <div class="mb-8">
            <form action="{{ route('posts.index') }}" method="GET" class="max-w-2xl">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                <div class="relative">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search articles..."
                        class="w-full pl-12 pr-4 py-4 rounded-2xl border border-slate-200 bg-white text-slate-900 placeholder-slate-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                    <svg class="absolute left-4 top-4.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </form>
        </div>

        <!-- Categories -->
        @if($categories->count())
        <div class="mb-10 flex flex-wrap gap-3">
            <a href="{{ route('posts.index', request('search') ? ['search' => request('search')] : []) }}"
               class="px-5 py-2.5 rounded-full text-sm font-medium transition border
               {{ !request('category') ? 'bg-slate-900 text-white border-slate-900 shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:border-purple-300 hover:text-purple-600' }}">
                All Posts
            </a>

            @foreach($categories as $category)
            <a href="{{ route('posts.index', array_filter([
                    'category' => $category->slug,
                    'search' => request('search')
                ])) }}"
               class="px-5 py-2.5 rounded-full text-sm font-medium transition border
               {{ request('category') == $category->slug ? 'bg-slate-900 text-white border-slate-900 shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:border-purple-300 hover:text-purple-600' }}">
                {{ $category->name }} ({{ $category->posts_count }})
            </a>
            @endforeach

            @if(request('category') || request('search'))
            <a href="{{ route('posts.index') }}"
               class="px-2 py-2.5 text-sm text-slate-500 hover:text-slate-700 underline underline-offset-4">
                Clear
            </a>
            @endif
        </div>
        @endif

        <!-- Posts Grid -->
        <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-8">
            @forelse($posts as $post)
                @php
                    $sampleIndex = $loop->index % count($sampleImages);

                    $postImage = $post->featured_image
                        ? asset('storage/'.$post->featured_image)
                        : $sampleImages[$sampleIndex];

                    $postTitle = !empty($post->title)
                        ? $post->title
                        : $sampleTitles[$sampleIndex];

                    $postExcerpt = !empty($post->excerpt)
                        ? $post->excerpt
                        : $sampleExcerpts[$sampleIndex];

                    $firstCategory = $post->categories->first();
                    $badgeCategory = $firstCategory?->name ?? $sampleCategories[$sampleIndex];
                    $readingTime = $post->reading_time ?? 5;
                @endphp

                <article class="group bg-white rounded-3xl border border-slate-200/70 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 overflow-hidden">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ $postImage }}"
                             alt="{{ $postTitle }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-700">

                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1.5 rounded-full bg-white/90 backdrop-blur text-xs font-semibold text-purple-700 shadow">
                                {{ $badgeCategory }}
                            </span>
                        </div>

                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1.5 rounded-full bg-black/50 text-white text-xs font-semibold">
                                {{ $readingTime }} min read
                            </span>
                        </div>
                    </div>

                    <div class="p-6 sm:p-7">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-11 h-11 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0">
                                {{ strtoupper(substr($post->user->name ?? 'U', 0, 1)) }}
                            </div>

                            <div class="min-w-0">
                                <p class="font-semibold text-slate-900 truncate">
                                    {{ $post->user->name ?? 'Unknown Author' }}
                                </p>
                                <p class="text-sm text-slate-500">
                                    {{ $post->published_at ? $post->published_at->diffForHumans() : 'Recently' }}
                                </p>
                            </div>
                        </div>

                        <h2 class="text-xl font-bold text-slate-900 leading-snug mb-3 line-clamp-2 group-hover:text-purple-600 transition-colors">
                            <a href="{{ route('posts.show', $post) }}">
                                {{ $postTitle }}
                            </a>
                        </h2>

                        <p class="text-slate-600 leading-7 mb-6 line-clamp-3">
                            {{ Str::limit($postExcerpt, 120) }}
                        </p>

                        <div class="flex items-center justify-between pt-5 border-t border-slate-100">
                            <span class="text-sm text-slate-500">
                                {{ $readingTime }} min read
                            </span>

                            <a href="{{ route('posts.show', $post) }}"
                               class="inline-flex items-center text-purple-600 font-semibold hover:text-purple-700 transition">
                                Read More
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>

            @empty
                <div class="sm:col-span-2 xl:col-span-3">
                    <div class="text-center py-20 bg-white rounded-3xl border border-slate-200 shadow-sm">
                        <div class="w-24 h-24 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>

                        <h3 class="text-2xl font-bold text-slate-900 mb-2">No articles found</h3>
                        <p class="text-slate-500 max-w-md mx-auto">
                            Try a different search or category, or check back later for new content.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="mt-14 pt-2">
                {{ $posts->withQueryString()->links() }}
            </div>
        @endif
    </div>
</section>

<style>
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}

.animate-blob {
    animation: blob 8s infinite ease-in-out;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection