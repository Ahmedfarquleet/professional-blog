@extends('layouts.app')

@section('title', 'Create New Post')
@section('meta_description', 'Create and publish a new blog post')

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-purple-950 to-violet-950">
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-72 h-72 bg-purple-400 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute top-10 right-0 w-72 h-72 bg-pink-400 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 left-1/3 w-72 h-72 bg-indigo-400 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-24">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/15 text-white/90 text-sm font-semibold uppercase tracking-[0.2em]">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                New Article
            </span>

            <h1 class="mt-6 text-4xl sm:text-5xl font-bold text-white tracking-tight leading-tight">
                Create New Post
            </h1>

            <p class="mt-5 text-lg text-slate-300 leading-8 max-w-2xl">
                Share your thoughts, insights, and ideas with your readers in a polished and engaging format.
            </p>
        </div>
    </div>
</section>

<section class="bg-slate-50 py-12 sm:py-16 min-h-[60vh]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-700 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-700 shadow-sm">
                <div class="font-semibold mb-2">Please fix the following errors:</div>
                <ul class="list-disc pl-5 space-y-1 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-8 items-start">
            <!-- Main Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-6 sm:px-8 py-6 border-b border-slate-200 bg-slate-50/80">
                        <h2 class="text-xl font-semibold text-slate-900">Post Details</h2>
                        <p class="text-sm text-slate-500 mt-1">Fill in the content and publishing details for your article.</p>
                    </div>

                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-7">
                        @csrf

                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Title *</label>
                            <input
                                type="text"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="Enter your post title"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3.5 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                required
                            >
                        </div>

                        <!-- Excerpt -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Excerpt</label>
                            <textarea
                                name="excerpt"
                                rows="4"
                                placeholder="Write a short summary for your post..."
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3.5 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none"
                            >{{ old('excerpt') }}</textarea>
                        </div>

                        <!-- Body -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Content *</label>
                            <textarea
                                name="body"
                                rows="14"
                                placeholder="Start writing your article here..."
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3.5 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                required
                            >{{ old('body') }}</textarea>
                        </div>

                        <!-- Featured Image -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Featured Image</label>
                            <input
                                type="file"
                                name="featured_image"
                                accept="image/*"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-700 file:mr-4 file:rounded-xl file:border-0 file:bg-slate-100 file:px-4 file:py-2 file:text-sm file:font-medium file:text-slate-700 hover:file:bg-slate-200"
                            >
                            <p class="text-xs text-slate-500 mt-2">Upload a cover image to make your article stand out.</p>
                        </div>

                        <!-- Categories -->
                        @if(isset($categories) && $categories->count() > 0)
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-3">Categories</label>
                            <div class="grid sm:grid-cols-2 gap-3">
                                @foreach($categories as $category)
                                    <label class="flex items-center gap-3 rounded-2xl border border-slate-200 p-4 hover:border-purple-300 hover:bg-purple-50/40 transition">
                                        <input
                                            type="checkbox"
                                            name="categories[]"
                                            value="{{ $category->id }}"
                                            class="rounded border-slate-300 text-purple-600 focus:ring-purple-500"
                                            {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
                                        >
                                        <span class="text-slate-700 font-medium">{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Tags -->
                        @if(isset($tags) && $tags->count() > 0)
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-3">Tags</label>
                            <div class="grid sm:grid-cols-2 gap-3">
                                @foreach($tags as $tag)
                                    <label class="flex items-center gap-3 rounded-2xl border border-slate-200 p-4 hover:border-purple-300 hover:bg-purple-50/40 transition">
                                        <input
                                            type="checkbox"
                                            name="tags[]"
                                            value="{{ $tag->id }}"
                                            class="rounded border-slate-300 text-purple-600 focus:ring-purple-500"
                                            {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                                        >
                                        <span class="text-slate-700 font-medium">{{ $tag->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Publish -->
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4">
                            <label class="flex items-center gap-3">
                                <input
                                    type="checkbox"
                                    name="is_published"
                                    value="1"
                                    class="rounded border-slate-300 text-purple-600 focus:ring-purple-500"
                                    {{ old('is_published') ? 'checked' : '' }}
                                >
                                <div>
                                    <span class="block text-sm font-semibold text-slate-800">Publish immediately</span>
                                    <span class="block text-xs text-slate-500">If unchecked, the post can stay as a draft.</span>
                                </div>
                            </label>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3 pt-2">
                            <a href="{{ route('dashboard') }}"
                               class="inline-flex items-center justify-center px-6 py-3 rounded-2xl border border-slate-300 text-slate-700 font-medium hover:bg-slate-100 transition">
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center px-6 py-3 rounded-2xl bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 text-white font-semibold shadow hover:shadow-xl hover:-translate-y-0.5 transition"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Create Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Writing Tips</h3>
                    <div class="space-y-3 text-sm text-slate-600">
                        <div class="flex items-start gap-3">
                            <span class="mt-2 w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                            <span>Use a clear and compelling title that tells readers what to expect.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-2 w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                            <span>Write a short excerpt to improve previews on article cards and search results.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-2 w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                            <span>Add a featured image to make your post more visually appealing.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-2 w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                            <span>Choose categories and tags carefully so readers can discover your content.</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 rounded-3xl shadow-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-3">Before Publishing</h3>
                    <div class="space-y-3 text-sm text-white/90">
                        <div class="flex items-start gap-3">
                            <span class="mt-2 w-1.5 h-1.5 rounded-full bg-white"></span>
                            <span>Check grammar and spelling.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-2 w-1.5 h-1.5 rounded-full bg-white"></span>
                            <span>Make sure your excerpt is concise.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-2 w-1.5 h-1.5 rounded-full bg-white"></span>
                            <span>Confirm image and category selections.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</style>
@endsection