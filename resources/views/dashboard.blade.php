@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@php
    use Illuminate\Support\Str;

    $sampleImages = [
        'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=900&q=80',
        'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=80',
        'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&q=80',
        'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=900&q=80',
        'https://images.unsplash.com/photo-1484417894907-623942c8ee29?auto=format&fit=crop&w=900&q=80',
        'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=900&q=80',
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
        'Discover how thoughtful spacing and visual hierarchy create a smoother reading experience.',
        'Learn practical Laravel techniques that help you build cleaner and faster applications.',
        'A strong homepage should guide visitors clearly and highlight your best content first.',
        'Frontend workflows are evolving with better tools and more engaging interfaces.',
        'Small improvements in spacing, cards, and typography can elevate your dashboard quickly.',
        'A polished interface builds trust and helps visitors focus on the content that matters.',
    ];

    $recentActivity = [
        ['title' => 'New post draft created', 'time' => '2 hours ago', 'color' => 'green'],
        ['title' => 'One of your posts crossed 100 views', 'time' => '5 hours ago', 'color' => 'blue'],
        ['title' => 'A new comment was added', 'time' => '1 day ago', 'color' => 'purple'],
    ];
@endphp

<section class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100/80 py-8 sm:py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-purple-900 to-indigo-900 shadow-2xl mb-8">
            <div class="absolute inset-0 opacity-15 pointer-events-none">
                <div class="absolute -top-20 -right-12 w-72 h-72 bg-white rounded-full blur-3xl"></div>
                <div class="absolute -bottom-28 -left-16 w-80 h-80 bg-pink-400 rounded-full blur-3xl"></div>
                <div class="absolute top-10 left-1/3 w-56 h-56 bg-blue-400 rounded-full blur-3xl"></div>
            </div>

            <div class="relative px-6 py-8 sm:px-10 sm:py-12 lg:px-12 lg:py-14">
                <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-8">
                    <div class="max-w-3xl">
                        <div class="inline-flex items-center gap-3 mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-white/15 backdrop-blur-md flex items-center justify-center ring-1 ring-white/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="text-white/80 text-sm uppercase tracking-[0.2em] font-semibold">Creator Dashboard</span>
                        </div>

                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight leading-tight mb-4">
                            Welcome back, {{ auth()->user()->name }}!
                        </h1>

                        <p class="text-white/80 text-base sm:text-lg leading-8 max-w-2xl">
                            Here’s a quick overview of your publishing space. You currently have
                            <span class="font-semibold text-white">{{ $stats['total_posts'] }}</span> posts and
                            <span class="font-semibold text-white">{{ number_format($stats['total_views']) }}</span> total views.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('posts.create') }}"
                           class="inline-flex items-center justify-center px-6 py-3.5 rounded-xl bg-white text-slate-900 font-semibold shadow-lg hover:shadow-2xl hover:-translate-y-0.5 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            New Post
                        </a>

                        <a href="{{ route('posts.index') }}"
                           class="inline-flex items-center justify-center px-6 py-3.5 rounded-xl border border-white/20 bg-white/10 backdrop-blur text-white font-semibold hover:bg-white/15 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                            Manage Posts
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 sm:gap-6 mb-8">
            <div class="group rounded-3xl bg-white border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 p-6">
                <div class="flex items-start justify-between mb-5">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold uppercase tracking-widest text-blue-600">Posts</span>
                </div>
                <p class="text-3xl font-bold text-slate-900 mb-1">{{ $stats['total_posts'] }}</p>
                <p class="text-slate-500 text-sm">Total posts created</p>
            </div>

            <div class="group rounded-3xl bg-white border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 p-6">
                <div class="flex items-start justify-between mb-5">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold uppercase tracking-widest text-emerald-600">Published</span>
                </div>
                <p class="text-3xl font-bold text-slate-900 mb-1">{{ $stats['published_posts'] }}</p>
                <p class="text-slate-500 text-sm">Live articles</p>
            </div>

            <div class="group rounded-3xl bg-white border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 p-6">
                <div class="flex items-start justify-between mb-5">
                    <div class="w-12 h-12 rounded-2xl bg-violet-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold uppercase tracking-widest text-violet-600">Views</span>
                </div>
                <p class="text-3xl font-bold text-slate-900 mb-1">{{ number_format($stats['total_views']) }}</p>
                <p class="text-slate-500 text-sm">Audience reach</p>
            </div>

            <div class="group rounded-3xl bg-white border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 p-6">
                <div class="flex items-start justify-between mb-5">
                    <div class="w-12 h-12 rounded-2xl bg-pink-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold uppercase tracking-widest text-pink-600">Comments</span>
                </div>
                <p class="text-3xl font-bold text-slate-900 mb-1">{{ $stats['total_comments'] }}</p>
                <p class="text-slate-500 text-sm">Community responses</p>
            </div>
        </div>

        <div class="grid xl:grid-cols-3 gap-8">
            <div class="xl:col-span-2">
                <div class="rounded-3xl bg-white border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/80">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <h2 class="text-xl font-semibold text-slate-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                    Recent Posts
                                </h2>
                                <p class="text-sm text-slate-500 mt-1">A quick look at your latest content and performance.</p>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <button class="px-4 py-2 rounded-xl bg-slate-900 text-white text-sm font-medium" type="button">
                                    All
                                </button>
                                <button class="px-4 py-2 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-medium hover:bg-slate-50 transition" type="button">
                                    Published
                                </button>
                                <button class="px-4 py-2 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-medium hover:bg-slate-50 transition" type="button">
                                    Drafts
                                </button>
                            </div>
                        </div>
                    </div>

                    @if($posts->count() > 0)
                        <div class="divide-y divide-slate-200">
                            @foreach($posts as $post)
                                @php
                                    $sampleIndex = $loop->index % count($sampleImages);
                                    $postImage = $post->featured_image ? asset('storage/' . $post->featured_image) : $sampleImages[$sampleIndex];
                                    $postTitle = !empty($post->title) ? $post->title : $sampleTitles[$sampleIndex];
                                    $postExcerpt = !empty($post->excerpt) ? $post->excerpt : $sampleExcerpts[$sampleIndex];
                                @endphp

                                <div class="p-5 sm:p-6 hover:bg-slate-50/70 transition">
                                    <div class="flex flex-col lg:flex-row lg:items-center gap-5">
                                        <div class="flex items-start gap-4 flex-1 min-w-0">
                                            <img src="{{ $postImage }}"
                                                 alt="{{ $postTitle }}"
                                                 class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl object-cover shrink-0 border border-slate-200">

                                            <div class="min-w-0 flex-1">
                                                <div class="flex flex-wrap items-center gap-2 mb-2">
                                                    @if($post->is_published)
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                                            <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></span>
                                                            Published
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                                                            <span class="w-2 h-2 bg-amber-500 rounded-full mr-2"></span>
                                                            Draft
                                                        </span>
                                                    @endif
                                                </div>

                                                <h3 class="text-lg font-semibold text-slate-900 leading-snug mb-1 truncate">
                                                    <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-blue-600 transition">
                                                        {{ Str::limit($postTitle, 60) }}
                                                    </a>
                                                </h3>

                                                <p class="text-slate-600 text-sm leading-6 mb-3 max-w-2xl">
                                                    {{ Str::limit($postExcerpt, 100) }}
                                                </p>

                                                <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500">
                                                    <span class="inline-flex items-center">
                                                        <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                        {{ number_format($post->views) }} views
                                                    </span>

                                                    <span class="inline-flex items-center">
                                                        <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                        </svg>
                                                        {{ $post->comments_count ?? $post->comments->count() ?? 0 }} comments
                                                    </span>

                                                    <span>
                                                        {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Not published yet' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2 lg:justify-end">
                                            <a href="{{ route('posts.show', $post->slug) }}"
                                               class="inline-flex items-center justify-center p-2.5 rounded-xl text-blue-600 hover:bg-blue-50 transition"
                                               title="View">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>

                                            <a href="{{ route('posts.edit', $post->id) }}"
                                               class="inline-flex items-center justify-center p-2.5 rounded-xl text-emerald-600 hover:bg-emerald-50 transition"
                                               title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>

                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center justify-center p-2.5 rounded-xl text-red-600 hover:bg-red-50 transition"
                                                        title="Delete">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($posts->hasPages())
                            <div class="px-6 py-5 border-t border-slate-200 bg-slate-50/70">
                                {{ $posts->links() }}
                            </div>
                        @endif
                    @else
                        <div class="px-6 py-16 sm:py-20">
                            <div class="text-center max-w-md mx-auto">
                                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path>
                                    </svg>
                                </div>

                                <h3 class="text-2xl font-bold text-slate-900 mb-3">No posts yet</h3>
                                <p class="text-slate-500 mb-8 leading-7">
                                    Start sharing your ideas, tutorials, or updates with your readers. Your first post can set the tone for your whole blog.
                                </p>

                                <a href="{{ route('posts.create') }}"
                                   class="inline-flex items-center px-6 py-3.5 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Create Your First Post
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-3xl bg-white border border-slate-200 shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Quick Draft
                    </h3>

                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <input type="text"
                               name="title"
                               placeholder="Post title..."
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

                        <textarea rows="4"
                                  name="body"
                                  placeholder="Write something..."
                                  class="w-full px-4 py-3 rounded-xl border border-slate-200 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>

                        <button type="submit"
                                class="w-full inline-flex items-center justify-center px-5 py-3.5 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold shadow hover:shadow-lg transition">
                            Save Draft
                        </button>
                    </form>
                </div>

                <div class="rounded-3xl bg-white border border-slate-200 shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-5 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Recent Activity
                    </h3>

                    <div class="space-y-4">
                        @foreach($recentActivity as $activity)
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0
                                    {{ $activity['color'] === 'green' ? 'bg-green-100' : ($activity['color'] === 'blue' ? 'bg-blue-100' : 'bg-purple-100') }}">
                                    <svg class="w-5 h-5
                                        {{ $activity['color'] === 'green' ? 'text-green-600' : ($activity['color'] === 'blue' ? 'text-blue-600' : 'text-purple-600') }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($activity['color'] === 'green')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        @elseif($activity['color'] === 'blue')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        @endif
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-slate-900">{{ $activity['title'] }}</p>
                                    <p class="text-xs text-slate-500 mt-1">{{ $activity['time'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-3xl bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-600 shadow-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        Writing Tips
                    </h3>

                    <div class="space-y-3 text-sm text-white/90">
                        <div class="flex items-start gap-3">
                            <span class="mt-2 w-1.5 h-1.5 rounded-full bg-white"></span>
                            <span>Write stronger, more benefit-driven headlines.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-2 w-1.5 h-1.5 rounded-full bg-white"></span>
                            <span>Add featured images to make posts more engaging.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-2 w-1.5 h-1.5 rounded-full bg-white"></span>
                            <span>Keep intros short and hook readers early.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-2 w-1.5 h-1.5 rounded-full bg-white"></span>
                            <span>Respond to comments to build audience trust.</span>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl bg-white border border-slate-200 shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">This Week</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">Posts written</span>
                            <span class="font-semibold text-slate-900">{{ $stats['total_posts'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">Published</span>
                            <span class="font-semibold text-slate-900">{{ $stats['published_posts'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">Views</span>
                            <span class="font-semibold text-slate-900">{{ number_format($stats['total_views']) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">Comments</span>
                            <span class="font-semibold text-slate-900">{{ $stats['total_comments'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 9999px;
}

::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 9999px;
}

::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>
@endsection