<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services - Jiji Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .navbar-brand { color: #ff69b4 !important; font-weight: 700; }
        .service-card { transition: transform 0.2s; }
        .service-card:hover { transform: translateY(-5px); }
        .service-image { height: 200px; object-fit: cover; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Jiji Beauty</a>
            <div class="ms-auto">
                <a href="{{ route('seller.dashboard') }}" class="btn btn-light">← Dashboard</a>
                <a href="{{ route('services.create') }}" class="btn btn-success ms-2">+ Add Service</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Manage Your Services</h1>
            <span class="badge bg-primary fs-6">{{ $services->count() }} Services</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($services->isEmpty())
            <div class="text-center py-5">
                <h3>No services yet</h3>
                <p class="text-muted">Start by adding your first service!</p>
                <a href="{{ route('services.create') }}" class="btn btn-primary btn-lg">Add Your First Service</a>
            </div>
        @else
            <div class="row">
                @foreach($services as $service)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card service-card h-100">
                            @if($service->photo)
                                <img src="{{ asset('storage/' . $service->photo) }}" class="card-img-top service-image" alt="{{ $service->name }}">
                            @else
                                <div class="card-img-top service-image bg-light d-flex align-items-center justify-content-center">
                                    <span class="text-muted">No Image</span>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $service->name }}</h5>
                                <p class="card-text">
                                    <strong>Category:</strong> {{ $service->category }}<br>
                                    <strong>Status:</strong> 
                                    <span class="badge {{ $service->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($service->status) }}
                                    </span>
                                </p>
                                <p class="card-text text-muted small">
                                    {{ Str::limit($service->description, 100) }}
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="btn-group w-100">
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" 
                                                onclick="return confirm('Are you sure you want to delete this service?')">
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