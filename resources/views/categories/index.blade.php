@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('title', 'Categories')

@section('content')
<div class="categories-page">

    {{-- Hero Section --}}
    <section class="categories-hero">
        <div class="container">
            <div class="hero-content text-center">
                <div class="hero-badge">
                    <span class="dot"></span>
                    CATEGORIES
                </div>
                <h1>Browse Categories</h1>
                <p>Discover topics, explore ideas, and find articles that match your interests.</p>
            </div>
        </div>
    </section>

    {{-- Categories Section --}}
    <section class="categories-section">
        <div class="container">
            @if($categories->count())
                <div class="categories-grid">
                    @foreach($categories as $category)
                        <div class="category-card">
                            <div class="category-card-top">
                                <span class="category-badge">{{ $category->posts_count }} Posts</span>
                            </div>

                            <div class="category-card-body">
                                <h3>{{ $category->name }}</h3>

                                @if(!empty($category->description))
                                    <p>{{ Str::limit($category->description, 110) }}</p>
                                @else
                                    <p>
                                        Explore published articles and insights in {{ $category->name }}.
                                        Read useful content curated for readers who love this topic.
                                    </p>
                                @endif
                            </div>

                            <div class="category-card-footer">
                                <a href="{{ route('categories.show', $category->slug) }}" class="category-btn">
                                    View Articles
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <h3>No categories found</h3>
                    <p>There are no categories with published posts right now.</p>
                </div>
            @endif
        </div>
    </section>
</div>

<style>
    .categories-page {
        background: #f8fafc;
        min-height: 100vh;
    }

    .categories-hero {
        background: radial-gradient(circle at top left, rgba(128, 90, 213, 0.25), transparent 25%),
                    radial-gradient(circle at top right, rgba(168, 85, 247, 0.20), transparent 25%),
                    linear-gradient(135deg, #16052f 0%, #3b0764 55%, #4c1d95 100%);
        padding: 90px 0 100px;
        color: #fff;
    }

    .hero-content {
        max-width: 760px;
        margin: 0 auto;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 18px;
        border-radius: 999px;
        background: rgba(255,255,255,0.10);
        border: 1px solid rgba(255,255,255,0.12);
        color: #e9d5ff;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 3px;
        margin-bottom: 22px;
    }

    .hero-badge .dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: #34d399;
        display: inline-block;
    }

    .categories-hero h1 {
        font-size: 64px;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 18px;
    }

    .categories-hero p {
        font-size: 22px;
        color: rgba(255,255,255,0.78);
        margin-bottom: 0;
    }

    .categories-section {
        padding: 70px 0;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 28px;
    }

    .category-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        min-height: 250px;
    }

    .category-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(76, 29, 149, 0.14);
        border-color: #d8b4fe;
    }

    .category-card-top {
        margin-bottom: 20px;
    }

    .category-badge {
        display: inline-block;
        padding: 8px 14px;
        border-radius: 999px;
        background: #f3e8ff;
        color: #6b21a8;
        font-size: 13px;
        font-weight: 700;
    }

    .category-card-body h3 {
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 14px;
    }

    .category-card-body p {
        font-size: 15px;
        line-height: 1.8;
        color: #64748b;
        margin-bottom: 0;
    }

    .category-card-footer {
        margin-top: auto;
        padding-top: 24px;
    }

    .category-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 20px;
        border-radius: 14px;
        background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 100%);
        color: #fff;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.25s ease;
    }

    .category-btn:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(124, 58, 237, 0.25);
    }

    .empty-state {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 24px;
        padding: 50px 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
    }

    .empty-state h3 {
        font-size: 28px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .empty-state p {
        color: #64748b;
        margin-bottom: 0;
        font-size: 16px;
    }

    @media (max-width: 991px) {
        .categories-hero {
            padding: 70px 0 80px;
        }

        .categories-hero h1 {
            font-size: 46px;
        }

        .categories-hero p {
            font-size: 18px;
        }
    }

    @media (max-width: 576px) {
        .categories-hero h1 {
            font-size: 36px;
        }

        .hero-badge {
            font-size: 12px;
            letter-spacing: 2px;
        }

        .categories-section {
            padding: 50px 0;
        }

        .category-card {
            padding: 20px;
            border-radius: 20px;
        }
    }
</style>
@endsection