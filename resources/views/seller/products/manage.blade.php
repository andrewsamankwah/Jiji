<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Jiji Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .navbar-brand { color: #ff69b4 !important; font-weight: 700; }
        .product-card { transition: transform 0.2s; }
        .product-card:hover { transform: translateY(-5px); }
        .product-image { height: 200px; object-fit: cover; }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Jiji Beauty</a>
            <div class="ms-auto">
                <a href="{{ route('seller.dashboard') }}" class="btn btn-light">← Dashboard</a>
                <a href="{{ route('products.create') }}" class="btn btn-success ms-2">+ Add Product</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Manage Your Products</h1>
            <span class="badge bg-primary fs-6">{{ $products->count() }} Products</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($products->isEmpty())
            <div class="text-center py-5">
                <h3>No products yet</h3>
                <p class="text-muted">Start by adding your first product!</p>
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg">Add Your First Product</a>
            </div>
        @else
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card product-card h-100">
                            @if($product->photo)
                                <img src="{{ asset('storage/' . $product->photo) }}" class="card-img-top product-image" alt="{{ $product->name }}">
                            @else
                                <div class="card-img-top product-image bg-light d-flex align-items-center justify-content-center">
                                    <span class="text-muted">No Image</span>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">
                                    <strong>Category:</strong> {{ $product->category }}<br>
                                    <strong>Price:</strong> GH₵{{ number_format($product->price, 2) }}<br>
                                    <strong>Status:</strong> 
                                    <span class="badge {{ $product->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </p>
                                <p class="card-text text-muted small">
                                    {{ Str::limit($product->description, 100) }}
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="btn-group w-100">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" 
                                                onclick="return confirm('Are you sure you want to delete this product?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>