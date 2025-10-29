<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Jiji Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .product-image {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }
        .category-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(255, 105, 180, 0.9);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        .price-tag {
            color: #ff69b4;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .seller-info {
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('layouts.app')

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="text-center mb-3">
                    @if(isset($category))
                        {{ $category }} Products
                    @else
                        All Beauty Products
                    @endif
                </h1>
                <p class="text-center text-muted">
                    Discover amazing beauty products from trusted sellers
                </p>
            </div>
        </div>

        <!-- Category Filter -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    <a href="{{ route('products.all') }}" 
                       class="btn btn-outline-primary {{ !isset($category) ? 'active' : '' }}">
                        All Products
                    </a>
                    <a href="{{ route('products.category', 'Skincare') }}" 
                       class="btn btn-outline-primary {{ isset($category) && $category == 'Skincare' ? 'active' : '' }}">
                        Skincare
                    </a>
                    <a href="{{ route('products.category', 'Makeup') }}" 
                       class="btn btn-outline-primary {{ isset($category) && $category == 'Makeup' ? 'active' : '' }}">
                        Makeup
                    </a>
                    <a href="{{ route('products.category', 'Hair Care') }}" 
                       class="btn btn-outline-primary {{ isset($category) && $category == 'Hair Care' ? 'active' : '' }}">
                        Hair Care
                    </a>
                    <a href="{{ route('products.category', 'Nails') }}" 
                       class="btn btn-outline-primary {{ isset($category) && $category == 'Nails' ? 'active' : '' }}">
                        Nails
                    </a>
                    <a href="{{ route('products.category', 'Fragrance') }}" 
                       class="btn btn-outline-primary {{ isset($category) && $category == 'Fragrance' ? 'active' : '' }}">
                        Fragrance
                    </a>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        @if($products->isEmpty())
            <div class="text-center py-5">
                <h3>No products found</h3>
                <p class="text-muted">
                    @if(isset($category))
                        No {{ $category }} products available at the moment.
                    @else
                        No products available at the moment.
                    @endif
                </p>
            </div>
        @else
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card product-card h-100">
                            @if($product->photo)
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $product->photo) }}" 
                                         class="card-img-top product-image" 
                                         alt="{{ $product->name }}">
                                    <span class="category-badge">{{ $product->category }}</span>
                                </div>
                            @else
                                <div class="card-img-top product-image bg-light d-flex align-items-center justify-content-center">
                                    <span class="text-muted">No Image Available</span>
                                </div>
                            @endif
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text flex-grow-1">
                                    {{ Str::limit($product->description, 100) }}
                                </p>
                                
                                <div class="mt-auto">
                                    <div class="price-tag mb-2">
                                        GH₵{{ number_format($product->price, 2) }}
                                    </div>
                                    
                                    <div class="seller-info mb-3">
                                        <small>
                                            <strong>Seller:</strong> {{ $product->user->name }}<br>
                                            <strong>Location:</strong> {{ $product->location }}<br>
                                            <strong>Contact:</strong> {{ $product->contact_number }}
                                        </small>
                                    </div>
                                    
                                    <div class="d-grid gap-2">
                                        <a href="tel:{{ $product->contact_number }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            📞 Call Seller
                                        </a>
                                        <button class="btn btn-outline-secondary btn-sm" 
                                                onclick="alert('Product: {{ $product->name }}\nPrice: GH₵{{ number_format($product->price, 2) }}\nContact: {{ $product->contact_number }}')">
                                            ℹ️ Quick Info
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Product Count -->
            <div class="row mt-4">
                <div class="col-12">
                    <p class="text-center text-muted">
                        Showing {{ $products->count() }} 
                        @if(isset($category))
                            {{ $category }} 
                        @endif
                        product(s)
                    </p>
                </div>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-light mt-5 py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; 2024 Jiji Beauty. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>