@extends('layouts.app')

@section('title', 'Jiji Beauty - Home')

@section('content')
<style>
    /* Your existing CSS remains the same */
    /* Reset and ensure proper layout */
    body {
        margin: 0;
        padding: 0;
    }

    main {
        margin-top: 0;
        padding-top: 0;
    }

    .hero-section {
        position: relative;
        height: 70vh;
        min-height: 500px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        margin-top: 0;
        overflow: hidden;
    }

    .hero-slideshow {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .hero-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 1.5s ease-in-out;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .hero-slide.active {
        opacity: 1;
    }

    .hero-slide::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        padding: 0 20px;
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 700;
        color: #ff69b4;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        margin-bottom: 20px;
    }

    .hero-content p {
        font-size: 1.5rem;
        margin-bottom: 30px;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }

    .search-bar {
        max-width: 600px;
        margin: 0 auto;
    }

    .search-input-group {
        display: flex;
        background: white;
        border-radius: 50px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .search-input {
        flex: 1;
        padding: 15px 25px;
        border: none;
        outline: none;
        font-size: 1rem;
        background: transparent;
    }

    .search-button {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 15px 30px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .search-button:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }

    .slide-indicators {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 3;
    }

    .slide-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .slide-indicator.active {
        background: #ff69b4;
        transform: scale(1.2);
    }

    .section-title {
        text-align: center;
        margin: 50px 0 30px 0;
        font-size: 2rem;
        font-weight: 700;
        color: #333;
    }

    .products-grid, .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        padding: 20px;
        max-width: 1400px;
        margin: 0 auto;
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
    }

    .product-info, .service-info {
        padding: 20px;
    }

    .product-category, .service-duration {
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

    .product-price, .service-price {
        font-size: 1.4rem;
        font-weight: 700;
        color: #764ba2;
        margin-bottom: 15px;
    }

    .btn-add-cart, .btn-book {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-add-cart {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .btn-add-cart:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        color: white;
    }

    .btn-book {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .btn-book:hover {
        background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
        color: white;
    }

    .category-tabs {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin: 30px 0;
        flex-wrap: wrap;
    }

    .category-btn {
        padding: 12px 30px;
        border: 2px solid #667eea;
        background: white;
        color: #667eea;
        border-radius: 25px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .category-btn:hover, .category-btn.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    @media (max-width: 768px) {
        .hero-section {
            height: 60vh;
            min-height: 400px;
        }

        .hero-content h1 {
            font-size: 2.5rem;
        }

        .hero-content p {
            font-size: 1.2rem;
        }

        .search-input-group {
            flex-direction: column;
            border-radius: 25px;
        }

        .search-input {
            border-radius: 25px 25px 0 0;
        }

        .search-button {
            border-radius: 0 0 25px 25px;
        }

        .products-grid, .services-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .hero-content h1 {
            font-size: 2rem;
        }

        .hero-content p {
            font-size: 1rem;
        }
    }
</style>

<!-- Hero Section with Auto-Changing Images -->
<div class="hero-section">
    <!-- Slideshow Background -->
    <div class="hero-slideshow">
        <div class="hero-slide active" style="background-image: url('https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')"></div>
        <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1616394584738-fc6e612e71b9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')"></div>
        <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')"></div>
        <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1595475884562-073c30d45670?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2069&q=80')"></div>
        <!-- NEW: Facial Creams Image -->
        <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1620916566398-39f1143ab7be?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')"></div>
        <!-- NEW: Perfumes Image -->
        <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2069&q=80')"></div>
    </div>

    <!-- Hero Content -->
    <div class="hero-content">
        <h1>Jiji Beauty Homepage</h1>
        <p>Discover amazing beauty products and premium services</p>
        
        <!-- Fixed Search Bar -->
        <div class="search-bar">
            <form action="{{ route('search') }}" method="GET">
                <div class="search-input-group">
                    <input type="text" name="q" class="search-input" placeholder="Search for products or services..." value="{{ old('q') }}" required>
                    <button type="submit" class="search-button">
                        🔍 Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Slide Indicators -->
    <div class="slide-indicators">
        <div class="slide-indicator active" data-slide="0"></div>
        <div class="slide-indicator" data-slide="1"></div>
        <div class="slide-indicator" data-slide="2"></div>
        <div class="slide-indicator" data-slide="3"></div>
        <div class="slide-indicator" data-slide="4"></div>
        <div class="slide-indicator" data-slide="5"></div>
    </div>
</div>

<!-- Featured Products Section -->
<div id="products">
    <h2 class="section-title">Featured Products</h2>
    
    <div class="category-tabs">
        <button class="category-btn active">All</button>
        <button class="category-btn">Skincare</button>
        <button class="category-btn">Makeup</button>
        <button class="category-btn">Hair Care</button>
    </div>

    <div class="products-grid">
        @forelse($products as $product)
            <div class="product-card" onclick="window.location.href='{{ route('products.show', $product->id) }}'">
                <div class="product-image">
                    @if($product->photo)
                        <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div style="font-size: 4rem;">📦</div>
                    @endif
                </div>
                <div class="product-info">
                    <div class="product-category">{{ $product->category }}</div>
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-price">GH₵{{ number_format($product->price, 2) }}</div>
                    @auth
                        <button class="btn-add-cart" onclick="event.stopPropagation(); window.location.href='{{ route('products.show', $product->id) }}'">
                            View Details
                        </button>
                    @else
                        <!-- No button for guests - entire card is clickable -->
                    @endauth
                </div>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; color: #666;">
                <p style="font-size: 3rem; margin-bottom: 20px;">📦</p>
                <h3 style="color: #333; margin-bottom: 10px;">No products available yet</h3>
                <p>Sellers can add products from their dashboard</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Popular Services Section -->
<div id="services">
    <h2 class="section-title">Popular Services</h2>
    
    <div class="services-grid">
        @forelse($services as $service)
            <div class="service-card" onclick="window.location.href='{{ route('services.show', $service->id) }}'">
                <div class="service-image">
                    @if($service->photo)
                        <img src="{{ asset('storage/' . $service->photo) }}" alt="{{ $service->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div style="font-size: 4rem;">💆‍♀️</div>
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
        @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; color: #666;">
                <p style="font-size: 3rem; margin-bottom: 20px;">💆‍♀️</p>
                <h3 style="color: #333; margin-bottom: 10px;">No services available yet</h3>
                <p>Sellers can add services from their dashboard</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    // Auto-changing hero slideshow
    let currentSlide = 0;
    const slides = document.querySelectorAll('.hero-slide');
    const indicators = document.querySelectorAll('.slide-indicator');
    const slideInterval = 5000; // 5 seconds

    function showSlide(index) {
        // Hide all slides
        slides.forEach(slide => slide.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));
        
        // Show current slide
        slides[index].classList.add('active');
        indicators[index].classList.add('active');
        
        currentSlide = index;
    }

    function nextSlide() {
        let next = (currentSlide + 1) % slides.length;
        showSlide(next);
    }

    // Auto-advance slides
    let slideTimer = setInterval(nextSlide, slideInterval);

    // Pause on hover
    const heroSection = document.querySelector('.hero-section');
    heroSection.addEventListener('mouseenter', () => clearInterval(slideTimer));
    heroSection.addEventListener('mouseleave', () => {
        slideTimer = setInterval(nextSlide, slideInterval);
    });

    // Click indicators to navigate
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            clearInterval(slideTimer);
            showSlide(index);
            slideTimer = setInterval(nextSlide, slideInterval);
        });
    });

    // Category filter functionality
    const categoryBtns = document.querySelectorAll('.category-btn');
    categoryBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            categoryBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>

<!-- Footer Section -->
@include('components.footer')
@endsection