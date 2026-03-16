<div class="space-y-6">
    <!-- Title -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
        <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" 
               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror" required>
        @error('title')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Excerpt -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
        <textarea name="excerpt" rows="3" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('excerpt') border-red-500 @enderror">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
        @error('excerpt')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Body -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
        <textarea name="body" rows="12" required
                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('body') border-red-500 @enderror">{{ old('body', $post->body ?? '') }}</textarea>
        @error('body')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Featured Image -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
        <input type="file" name="featured_image" accept="image/*"
               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('featured_image') border-red-500 @enderror">
        
        @if(!empty($post->featured_image ?? null))
            <img src="{{ asset('storage/'.$post->featured_image) }}" alt="Current" class="h-32 rounded-lg mt-2">
        @endif
        @error('featured_image')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Categories -->
    @if(isset($categories) && $categories->count())
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Categories</label>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            @foreach($categories as $category)
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                       {{ isset($post) && $post->categories->contains($category->id) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-700">{{ $category->name }}</span>
            </label>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Tags -->
    @if(isset($tags) && $tags->count())
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            @foreach($tags as $tag)
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                       {{ isset($post) && $post->tags->contains($tag->id) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-700">{{ $tag->name }}</span>
            </label>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Published -->
    <div class="flex items-center space-x-4">
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="is_published" value="1" 
                   {{ old('is_published', $post->is_published ?? false) ? 'checked' : '' }}
                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span class="text-sm font-medium text-gray-700">Publish immediately</span>
        </label>
    </div>

    <!-- Submit -->
    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
        <a href="{{ route('posts.index') }}" 
           class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Cancel</a>
        <button type="submit" 
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            {{ isset($post) ? 'Update' : 'Create' }} Post
        </button>
    </div>
</div>