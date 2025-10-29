@extends('layouts.app')

@section('title', 'Search Results - Jiji Beauty')

@section('content')
<style>
    .search-results-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .search-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .search-query {
        color: #667eea;
        font-weight: 700;
    }

    .results-count {
        color: #666;
        font-size: 1.1rem;
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #333;
        margin: 40px 0 20px 0;
        padding-bottom: 10px;
        border-bottom: 2px solid #667eea;
    }

    .no-results {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .no-results-icon {
        font-size: 4rem;
        margin-bottom: 20px;
    }

    .search-again {
        margin-top: 30px;
        text-align: center;
    }

    .btn-search-again {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-search-again:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Reuse your existing card styles */
    .products-grid, .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .product-card, .service-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .product-card:hover, .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .product-image, .service-image {
        width: 100%;
        height: 220px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
    }

    .product-image img, .service-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-info, .service-info {
        padding: 20px;
    }

    .product-category {
        font-size: 0.85rem;
        color: #667eea;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .product-name, .service-name {
        font-size: 1.2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 1.4rem;
        font-weight: 700;
        color: #764ba2;
        margin-bottom: 15px;
    }

    .btn-view-details, .btn-book {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        display: block;
    }

    .btn-view-details {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-view-details:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }

    .btn-book {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .btn-book:hover {
        background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
    }

    .guest-message {
        background: #fff3cd;
        border: 1px solid #ffeaa7;
        border-radius: 10px;
        padding: 15px;
        margin: 20px 0;
        text-align: center;
        color: #856404;
    }

    .guest-message a {
        color: #667eea;
        font-weight: 600;
        text-decoration: none;
    }

    .guest-message a:hover {
        text-decoration: underline;
    }
</style>

<div class="search-results-container">
    <div class="search-header">
        <h1>Search Results</h1>
        <p class="results-count">
            @if($products->count() > 0 || $services->count() > 0)
                Found {{ $products->count() }} product(s) and {{ $services->count() }} service(s) for 
                "<span class="search-query">{{ $query }}</span>"
            @else
                No results found for "<span class="search-query">{{ $query }}</span>"
            @endif
        </p>
    </div>

    @guest
        <div class="guest-message">
            🔍 You're viewing as a guest. <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register.user') }}">Sign up</a> to contact sellers directly or book appointments.
        </div>
    @endguest

    @if($products->count() > 0)
        <h2 class="section-title">Products</h2>
        <div class="products-grid">
            @foreach($products as $product)
                <div class="product-card" onclick="window.location.href='{{ route('products.show', $product->id) }}'">
                    <div class="product-image">
                        @if($product->photo)
                            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}">
                        @else
                            <div>📦</div>
                        @endif
                    </div>
                    <div class="product-info">
                        <div class="product-category">{{ $product->category }}</div>
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-price">GH₵{{ number_format($product->price, 2) }}</div>
                        
                        @auth
                            <!-- Logged-in users see contact details -->
                            <button class="btn-view-details" onclick="event.stopPropagation(); window.location.href='{{ route('products.show', $product->id) }}'">
                                View Details
                            </button>
                        @else
                            <!-- No button for guests - entire card is clickable -->
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if($services->count() > 0)
        <h2 class="section-title">Services</h2>
        <div class="services-grid">
            @foreach($services as $service)
                <div class="service-card" onclick="window.location.href='{{ route('services.show', $service->id) }}'">
                    <div class="service-image">
                        @if($service->photo)
                            <img src="{{ asset('storage/' . $service->photo) }}" alt="{{ $service->name }}">
                        @else
                            <div>💆‍♀️</div>
                        @endif
                    </div>
                    <div class="service-info">
                        <div class="service-name">{{ $service->name }}</div>
                        <p style="color: #666; margin: 10px 0;">{{ Str::limit($service->description, 80) }}</p>
                        
                        @auth
                            <a href="{{ route('book') }}" class="btn-book" onclick="event.stopPropagation();">
                                📅 Book Appointment
                            </a>
                        @else
                            <!-- No button for guests - entire card is clickable -->
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if($products->count() == 0 && $services->count() == 0)
        <div class="no-results">
            <div class="no-results-icon">🔍</div>
            <h3>No results found</h3>
            <p>We couldn't find any products or services matching "{{ $query }}"</p>
            <p>Try searching with different keywords or browse our categories.</p>
        </div>
    @endif

    <div class="search-again">
        <a href="{{ route('welcome') }}" class="btn-search-again">Search Again</a>
    </div>
</div>

<script>
    // Add search functionality to the results page
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.createElement('div');
        searchForm.innerHTML = `
            <div style="max-width: 600px; margin: 20px auto;">
                <form action="{{ route('search') }}" method="GET">
                    <div style="display: flex; background: white; border-radius: 50px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                        <input type="text" name="q" value="{{ $query }}" style="flex: 1; padding: 15px 25px; border: none; outline: none; font-size: 1rem;" placeholder="Search for products or services...">
                        <button type="submit" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 15px 25px; color: white; font-weight: 600; cursor: pointer;">
                            🔍 Search
                        </button>
                    </div>
                </form>
            </div>
        `;
        document.querySelector('.search-header').appendChild(searchForm);
    });
</script>
@endsection