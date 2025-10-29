@extends('layouts.app')

@section('title', $product->name . ' - Jiji Beauty')

@section('content')
<style>
    .product-details-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .product-details-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .product-image-section {
        padding: 0;
        position: relative;
    }

    .product-image {
        width: 100%;
        height: 400px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 8rem;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-info-section {
        padding: 40px;
    }

    .product-category {
        color: #667eea;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .product-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .product-price {
        font-size: 2rem;
        font-weight: 700;
        color: #764ba2;
        margin-bottom: 30px;
    }

    .product-description {
        color: #666;
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .seller-info {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 30px;
    }

    .seller-info h4 {
        color: #333;
        margin-bottom: 15px;
        font-size: 1.2rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        color: #666;
    }

    .info-item i {
        color: #667eea;
        margin-right: 10px;
        width: 20px;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .btn-primary, .btn-secondary {
        padding: 15px 30px;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        flex: 1;
        justify-content: center;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        color: white;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        flex: 1;
        justify-content: center;
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(240, 147, 251, 0.3);
        color: white;
    }

    .guest-message {
        background: #fff3cd;
        border: 1px solid #ffeaa7;
        border-radius: 10px;
        padding: 20px;
        margin-top: 30px;
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

    @media (max-width: 768px) {
        .product-title {
            font-size: 2rem;
        }
        
        .product-price {
            font-size: 1.5rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-primary, .btn-secondary {
            flex: none;
        }
    }
</style>

<div class="product-details-container">
    <div class="product-details-card">
        <div class="row g-0">
            <!-- Product Image -->
            <div class="col-md-6 product-image-section">
                <div class="product-image">
                    @if($product->photo)
                        <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}">
                    @else
                        <div>📦</div>
                    @endif
                </div>
            </div>
            
            <!-- Product Information -->
            <div class="col-md-6 product-info-section">
                <div class="product-category">{{ $product->category }}</div>
                <h1 class="product-title">{{ $product->name }}</h1>
                <div class="product-price">GH₵{{ number_format($product->price, 2) }}</div>
                
                <div class="product-description">
                    {{ $product->description }}
                </div>

                <!-- Seller Information -->
                <div class="seller-info">
                    <h4>📞 Contact Seller</h4>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <span>{{ $product->contact_number }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $product->location }}</span>
                    </div>
                    @if($product->user)
                    <div class="info-item">
                        <i class="fas fa-store"></i>
                        <span>Sold by: {{ $product->user->name }}</span>
                    </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    @auth
                        <button class="btn-primary" onclick="contactSeller('{{ $product->contact_number }}', '{{ $product->name }}')">
                            <i class="fas fa-phone"></i>
                            Contact Seller
                        </button>
                    @else
                        <a href="{{ route('login') }}?message=Login to contact seller for {{ $product->name }}" class="btn-primary">
                            <i class="fas fa-phone"></i>
                            Contact Seller
                        </a>
                    @endauth
                    
                    <a href="{{ route('welcome') }}" class="btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Back to Home
                    </a>
                </div>

                @guest
                <div class="guest-message">
                    🔐 <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register.user') }}">Sign up</a> to contact sellers directly and purchase products.
                </div>
                @endguest
            </div>
        </div>
    </div>
</div>

<script>
    function contactSeller(phoneNumber, productName) {
        if (confirm(`Contact seller for ${productName}?\n\nPhone: ${phoneNumber}\n\nWould you like to call now?`)) {
            window.location.href = `tel:${phoneNumber}`;
        }
    }
</script>

<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection