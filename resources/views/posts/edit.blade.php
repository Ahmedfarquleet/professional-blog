@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Edit Post</h1>
        <p class="text-gray-600 mt-2">Update your post</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                    <input type="text" 
                           name="title" 
                           value="{{ old('title', $post->title) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                           required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Excerpt -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Excerpt (Short summary)</label>
                    <textarea name="excerpt" 
                              rows="3"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('excerpt') border-red-500 @enderror">{{ old('excerpt', $post->excerpt) }}</textarea>
                    @error('excerpt')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Body -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Content <span class="text-red-500">*</span></label>
                    <textarea name="body" 
                              rows="12"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('body') border-red-500 @enderror"
                              required>{{ old('body', $post->body) }}</textarea>
                    @error('body')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Featured Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                    <input type="file" 
                           name="featured_image"
                           accept="image/*"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 @error('featured_image') border-red-500 @enderror">
                    
                    @if($post->featured_image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Current featured image" class="h-32 rounded-lg">
                            <p class="text-sm text-gray-500 mt-1">Current image. Upload new to replace.</p>
                        </div>
                    @endif
                    
                    @error('featured_image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Categories -->
                @if(isset($categories) && $categories->count() > 0)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categories</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($categories as $category)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" 
                                   name="categories[]" 
                                   value="{{ $category->id }}"
                                   {{ in_array($category->id, $post->categories->pluck('id')->toArray()) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span>{{ $category->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Tags -->
                @if(isset($tags) && $tags->count() > 0)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($tags as $tag)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" 
                                   name="tags[]" 
                                   value="{{ $tag->id }}"
                                   {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span>{{ $tag->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Publish Checkbox -->
                <div class="flex items-center">
                    <input type="checkbox" 
                           name="is_published" 
                           id="is_published"
                           value="1"
                           {{ $post->is_published ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="is_published" class="ml-2 text-sm text-gray-700">
                        Published
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Update Post
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection