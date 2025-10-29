<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Jiji Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .navbar-brand { color: #ff69b4 !important; font-weight: 700; }
        .form-container { max-width: 800px; margin: 40px auto; padding: 20px; }
        .form-card { background: white; border-radius: 15px; padding: 40px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .image-preview img { max-width: 100%; max-height: 300px; border-radius: 10px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Jiji Beauty</a>
            <div class="ms-auto">
                <a href="{{ route('products.manage') }}" class="btn btn-light">← Back to Products</a>
            </div>
        </div>
    </nav>

    <div class="form-container">
        <div class="form-card">
            <div class="text-center mb-4">
                <h1>Edit Product</h1>
                <p class="text-muted">Update your product information</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <!-- Product Name -->
                        <div class="mb-3">
                            <label class="form-label">Product Name *</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}" required>
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label class="form-label">Category *</label>
                            <select class="form-select" name="category" required>
                                <option value="Skincare" {{ $product->category == 'Skincare' ? 'selected' : '' }}>Skincare</option>
                                <option value="Makeup" {{ $product->category == 'Makeup' ? 'selected' : '' }}>Makeup</option>
                                <option value="Hair Care" {{ $product->category == 'Hair Care' ? 'selected' : '' }}>Hair Care</option>
                                <option value="Nails" {{ $product->category == 'Nails' ? 'selected' : '' }}>Nails</option>
                                <option value="Fragrance" {{ $product->category == 'Fragrance' ? 'selected' : '' }}>Fragrance</option>
                                <option value="Body Care" {{ $product->category == 'Body Care' ? 'selected' : '' }}>Body Care</option>
                                <option value="Other" {{ $product->category == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label class="form-label">Price (GH₵) *</label>
                            <input type="number" class="form-control" name="price" step="0.01" min="0" 
                                   value="{{ old('price', $product->price) }}" required>
                        </div>

                        <!-- Contact Number -->
                        <div class="mb-3">
                            <label class="form-label">Contact Number *</label>
                            <input type="tel" class="form-control" name="contact_number" 
                                   value="{{ old('contact_number', $product->contact_number) }}" required>
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label class="form-label">Location *</label>
                            <input type="text" class="form-control" name="location" 
                                   value="{{ old('location', $product->location) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Current Photo -->
                        <div class="mb-3">
                            <label class="form-label">Current Photo</label>
                            @if($product->photo)
                                <div class="image-preview">
                                    <img src="{{ asset('storage/' . $product->photo) }}" alt="Current Product Photo" class="img-fluid">
                                </div>
                            @else
                                <p class="text-muted">No photo uploaded</p>
                            @endif
                        </div>

                        <!-- New Photo -->
                        <div class="mb-3">
                            <label class="form-label">Update Photo (Optional)</label>
                            <input type="file" class="form-control" name="photo" accept="image/*">
                            <small class="text-muted">Leave empty to keep current photo</small>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="form-label">Description *</label>
                    <textarea class="form-control" name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Update Product</button>
                    <a href="{{ route('products.manage') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>