<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Jiji Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Jiji Beauty</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/">Home</a>
                <a class="nav-link" href="/products">Products</a>
                <a class="nav-link" href="/services">Services</a>
                <a class="nav-link" href="/book">Book Appointment</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>All Products</h1>
        
        @if($products->isEmpty())
            <div class="alert alert-info">
                No products found.
            </div>
        @else
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if($product->photo)
                                <img src="{{ asset('storage/' . $product->photo) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text"><strong>Price: GH₵{{ $product->price }}</strong></p>
                                <p class="card-text"><small>Category: {{ $product->category }}</small></p>
                                <p class="card-text"><small>Seller: {{ $product->user->name }}</small></p>
                                <p class="card-text"><small>Contact: {{ $product->contact_number }}</small></p>
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