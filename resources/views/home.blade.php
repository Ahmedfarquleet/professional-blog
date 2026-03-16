@extends('layouts.app')

@section('content')


@if($featuredPost)
@else
<section class="relative overflow-hidden bg-gradient-to-br from-purple-900 via-purple-800 to-indigo-900 text-white">
    <div class="max-w-7xl mx-auto px-6 py-20">
        <span class="inline-block px-4 py-2 rounded-full bg-white/10 text-sm font-semibold uppercase">
            Featured Story
        </span>

        <h1 class="mt-6 text-5xl font-extrabold leading-tight">
            Welcome to BlogSpace
        </h1>

        <p class="mt-6 text-lg text-purple-100 max-w-2xl">
            Discover fresh stories, ideas, and insights from our writers.
        </p>

        <div class="mt-10 flex gap-4">
            <a href="{{ route('posts.index') }}" class="bg-white text-gray-900 px-6 py-3 rounded-lg font-semibold">
                Read Articles
            </a>
            <a href="{{ route('categories.index') }}" class="border border-white/30 px-6 py-3 rounded-lg font-semibold">
                Browse Categories
            </a>
        </div>
    </div>
</section>
@endif
@php
    $featuredImageUrl = $featuredPost->featured_image
        ? asset('storage/'.$featuredPost->featured_image)
        : 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&w=1350&q=80';
@endphp

<section class="relative overflow-hidden bg-gradient-to-br from-indigo-950 via-purple-950 to-slate-950">
    <!-- Animated background elements -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl animate-float"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl animate-float animation-delay-2000"></div>
        <div class="absolute bottom-0 left-1/3 w-96 h-96 bg-pink-400 rounded-full mix-blend-multiply filter blur-3xl animate-float animation-delay-4000"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Content Section -->
            <div class="max-w-2xl">
                <!-- Featured Badge -->
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full border border-white/20 mb-8">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    <span class="text-sm font-semibold text-white uppercase tracking-wider">Featured Story</span>
                </div>

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                    {{ $featuredPost->title ?? 'Insights That Inspire Innovation' }}
                </h1>

                <!-- Excerpt -->
                <p class="text-lg text-slate-300 leading-relaxed mb-8">
                    {{ $featuredPost->excerpt ?? 'Discover thoughtful perspectives on technology, design, and digital craftsmanship from industry experts.' }}
                </p>

                <!-- Author Info -->
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-amber-400 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-xl ring-4 ring-white/20">
                        {{ strtoupper(substr($featuredPost->user->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-white text-lg">
                            {{ $featuredPost->user->name ?? 'Alex Morgan' }}
                        </p>
                        <div class="flex items-center gap-2 text-slate-400">
                            <span>{{ $featuredPost->created_at ? $featuredPost->created_at->format('F j, Y') : 'March 15, 2025' }}</span>
                            <span class="w-1 h-1 bg-slate-500 rounded-full"></span>
                            <span>8 min read</span>
                        </div>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('posts.show', $featuredPost) }}" 
                       class="group inline-flex items-center px-8 py-4 bg-white text-slate-900 rounded-xl font-semibold shadow-2xl hover:shadow-3xl hover:-translate-y-0.5 transition-all duration-300">
                        Read Article
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="#latest-posts" 
                       class="inline-flex items-center px-8 py-4 border border-white/30 text-white rounded-xl font-semibold hover:bg-white/10 hover:border-white/50 transition-all duration-300">
                        Browse All Posts
                    </a>
                </div>
            </div>

            <!-- Featured Image -->
            <div class="relative hidden lg:block">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl ring-1 ring-white/20">
                    <img src="{{ $featuredImageUrl }}" 
                         alt="Featured post cover image" 
                         class="w-full h-[600px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                </div>
                
                <!-- Stats Card -->
                <div class="absolute -bottom-6 -left-6 bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-5 shadow-2xl">
                    <p class="text-sm text-slate-300 mb-1">Popular this week</p>
                    <p class="text-2xl font-bold text-white">2.5k+ reads</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Latest Posts Section -->
<section id="latest-posts" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="max-w-3xl mx-auto text-center mb-16">
            <span class="text-indigo-600 font-semibold text-sm uppercase tracking-widest">The Chronicle</span>
            <h2 class="mt-4 text-4xl md:text-5xl font-bold text-slate-900 tracking-tight">
                Latest Stories
            </h2>
            <p class="mt-4 text-lg text-slate-600 leading-relaxed">
                Curated insights and perspectives from our community of writers and thinkers.
            </p>
        </div>

        <!-- Category Filters -->
        <div class="flex flex-wrap justify-center gap-3 mb-16">
            <button class="px-6 py-3 rounded-full bg-indigo-600 text-white font-medium shadow-lg shadow-indigo-200 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                All Posts
            </button>
            <button class="px-6 py-3 rounded-full bg-white text-slate-700 border border-slate-200 font-medium hover:border-indigo-300 hover:text-indigo-600 hover:-translate-y-0.5 transition-all duration-300">
                Technology
            </button>
            <button class="px-6 py-3 rounded-full bg-white text-slate-700 border border-slate-200 font-medium hover:border-indigo-300 hover:text-indigo-600 hover:-translate-y-0.5 transition-all duration-300">
                Design
            </button>
            <button class="px-6 py-3 rounded-full bg-white text-slate-700 border border-slate-200 font-medium hover:border-indigo-300 hover:text-indigo-600 hover:-translate-y-0.5 transition-all duration-300">
                Development
            </button>
            <button class="px-6 py-3 rounded-full bg-white text-slate-700 border border-slate-200 font-medium hover:border-indigo-300 hover:text-indigo-600 hover:-translate-y-0.5 transition-all duration-300">
                Business
            </button>
        </div>

        @if($latestPosts && $latestPosts->count() > 0)
            <!-- Posts Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latestPosts as $index => $post)
                    @php
                        $gradients = ['from-indigo-500 to-purple-600', 'from-amber-500 to-pink-500', 'from-emerald-500 to-teal-500', 'from-blue-500 to-cyan-500', 'from-orange-500 to-red-500', 'from-purple-500 to-violet-500'];
                        $gradient = $gradients[$index % count($gradients)];
                        $postImage = $post->featured_image ? asset('storage/'.$post->featured_image) : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&q=80';
                    @endphp

                    <article class="group bg-white rounded-2xl shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden border border-slate-100">
                        <!-- Image Container -->
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $postImage }}" 
                                 alt="{{ $post->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            
                            <!-- Category Tag -->
                            <div class="absolute top-4 left-4">
                                <span class="px-4 py-2 rounded-full bg-white/95 backdrop-blur text-sm font-semibold text-indigo-600 shadow-lg">
                                    {{ $post->category->name ?? 'Technology' }}
                                </span>
                            </div>

                            <!-- Reading Time -->
                            <div class="absolute top-4 right-4">
                                <span class="px-4 py-2 rounded-full bg-black/50 backdrop-blur text-white text-sm font-medium">
                                    6 min read
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-7">
                            <!-- Author -->
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br {{ $gradient }} flex items-center justify-center text-white font-bold text-lg shrink-0 shadow-lg">
                                    {{ strtoupper(substr($post->user->name ?? 'A', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $post->user->name ?? 'Sarah Chen' }}</p>
                                    <p class="text-sm text-slate-500">{{ $post->created_at ? $post->created_at->format('M j, Y') : 'Mar 12, 2025' }}</p>
                                </div>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold text-slate-900 leading-snug mb-3 group-hover:text-indigo-600 transition-colors line-clamp-2">
                                <a href="{{ route('posts.show', $post) }}">
                                    {{ $post->title }}
                                </a>
                            </h3>

                            <!-- Excerpt -->
                            <p class="text-slate-600 leading-relaxed mb-6 line-clamp-3">
                                {{ $post->excerpt }}
                            </p>

                            <!-- Footer -->
                            <div class="flex items-center justify-between pt-5 border-t border-slate-100">
                                <span class="text-sm text-slate-400">Insights & Ideas</span>
                                <a href="{{ route('posts.show', $post) }}" 
                                   class="inline-flex items-center text-indigo-600 font-semibold hover:text-indigo-700 group-hover:translate-x-1 transition-all">
                                    Continue Reading
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-16">
                <button class="inline-flex items-center px-8 py-4 bg-white border-2 border-indigo-600 text-indigo-600 rounded-xl font-semibold hover:bg-indigo-600 hover:text-white hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    Load More Articles
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
            </div>
        @else
            <!-- Demo Posts (shown only when no posts exist) -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $demoPosts = [
                        [
                            'title' => 'The Future of Web Development: What to Expect in 2025',
                            'excerpt' => 'Exploring emerging trends and technologies that will shape the next generation of web applications.',
                            'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&q=80',
                            'category' => 'Technology',
                            'author' => 'Alex Rivera',
                            'date' => 'Mar 10, 2025'
                        ],
                        [
                            'title' => 'Designing for Accessibility: A Practical Guide',
                            'excerpt' => 'Learn how to create inclusive digital experiences that work for everyone, regardless of ability.',
                            'image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80',
                            'category' => 'Design',
                            'author' => 'Maya Patel',
                            'date' => 'Mar 8, 2025'
                        ],
                        [
                            'title' => 'Building Scalable Laravel Applications',
                            'excerpt' => 'Architecture patterns and best practices for growing your Laravel projects from startup to enterprise.',
                            'image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1200&q=80',
                            'category' => 'Development',
                            'author' => 'James Wilson',
                            'date' => 'Mar 5, 2025'
                        ]
                    ];
                @endphp

                @foreach($demoPosts as $demo)
                    <article class="group bg-white rounded-2xl shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $demo['image'] }}" alt="{{ $demo['title'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-4 left-4">
                                <span class="px-4 py-2 rounded-full bg-white/95 backdrop-blur text-sm font-semibold text-indigo-600">{{ $demo['category'] }}</span>
                            </div>
                        </div>
                        <div class="p-7">
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg">
                                    {{ substr($demo['author'], 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $demo['author'] }}</p>
                                    <p class="text-sm text-slate-500">{{ $demo['date'] }}</p>
                                </div>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3 line-clamp-2">{{ $demo['title'] }}</h3>
                            <p class="text-slate-600 leading-relaxed mb-6 line-clamp-3">{{ $demo['excerpt'] }}</p>
                            <div class="flex items-center justify-between pt-5 border-t border-slate-100">
                                <span class="text-sm text-slate-400">Featured Story</span>
                                <span class="inline-flex items-center text-indigo-600 font-semibold group-hover:translate-x-1 transition-all">
                                    Preview
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Newsletter Section -->
<section class="bg-slate-900 py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative bg-gradient-to-br from-indigo-900/50 to-purple-900/50 rounded-3xl p-12 text-center border border-white/10 backdrop-blur-xl overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse animation-delay-2000"></div>
            
            <div class="relative">
                <h2 class="text-4xl font-bold text-white mb-4">Stay in the Loop</h2>
                <p class="text-slate-300 text-lg mb-10 max-w-2xl mx-auto">
                    Join our newsletter and receive weekly insights from industry experts, delivered straight to your inbox.
                </p>
                
                <form class="flex flex-col sm:flex-row gap-4 max-w-xl mx-auto">
                    <input type="email" 
                           placeholder="Enter your email address" 
                           class="flex-1 px-6 py-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    <button type="submit" 
                            class="px-8 py-4 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold shadow-xl hover:shadow-2xl hover:-translate-y-0.5 hover:scale-105 transition-all duration-300">
                        Subscribe Now
                    </button>
                </form>
                
                <p class="text-sm text-slate-400 mt-6">
                    No spam. Just great content. Unsubscribe anytime.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Custom Animations -->
<style>
@keyframes float {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
}

.animate-float {
    animation: float 12s infinite ease-in-out;
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

@keyframes pulse {
    0%, 100% { opacity: 0.2; }
    50% { opacity: 0.3; }
}

.animate-pulse {
    animation: pulse 4s infinite;
}
</style>

@endsection