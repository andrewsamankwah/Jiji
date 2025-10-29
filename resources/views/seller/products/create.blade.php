<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Jiji Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f5f7fa;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: #ff69b4 !important;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            margin: 0 10px;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-back:hover {
            background: white;
            color: #667eea;
        }

        .form-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
        }

        .form-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h1 {
            color: #333;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #666;
            font-size: 1rem;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .required {
            color: #dc3545;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .image-upload {
            border: 3px dashed #667eea;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8f9ff;
        }

        .image-upload:hover {
            background: #e8ebff;
            border-color: #764ba2;
        }

        .image-upload-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 15px;
        }

        .image-upload-text {
            color: #666;
            font-size: 1rem;
        }

        .image-preview {
            display: none;
            margin-top: 20px;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 300px;
            border-radius: 10px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            padding: 15px;
            font-size: 1.1rem;
            width: 100%;
            margin-top: 30px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        .form-text {
            color: #6c757d;
            font-size: 0.875rem;
            margin-top: 5px;
        }

        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Jiji Beauty</a>
            <div class="ms-auto">
                <a href="{{ route('seller.dashboard') }}" class="btn-back">← Back to Dashboard</a>
            </div>
        </div>
    </nav>

    <!-- Form Container -->
    <div class="form-container">
        <div class="form-card">
            <div class="form-header">
                <h1>Add New Product</h1>
                <p>Fill in the details below to list your product</p>
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

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Product Name -->
                <div class="mb-4">
                    <label for="name" class="form-label">Product Name <span class="required">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" required 
                           placeholder="e.g., Luxury Face Cream" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-4">
                    <label for="category" class="form-label">Category <span class="required">*</span></label>
                    <select class="form-select @error('category') is-invalid @enderror" 
                            id="category" name="category" required>
                        <option value="">Select a category</option>
                        <option value="Skincare" {{ old('category') == 'Skincare' ? 'selected' : '' }}>Skincare</option>
                        <option value="Makeup" {{ old('category') == 'Makeup' ? 'selected' : '' }}>Makeup</option>
                        <option value="Hair Care" {{ old('category') == 'Hair Care' ? 'selected' : '' }}>Hair Care</option>
                        <option value="Nails" {{ old('category') == 'Nails' ? 'selected' : '' }}>Nails</option>
                        <option value="Fragrance" {{ old('category') == 'Fragrance' ? 'selected' : '' }}>Fragrance</option>
                        <option value="Body Care" {{ old('category') == 'Body Care' ? 'selected' : '' }}>Body Care</option>
                        <option value="Tools & Accessories" {{ old('category') == 'Tools & Accessories' ? 'selected' : '' }}>Tools & Accessories</option>
                        <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="price" class="form-label">Price (GH₵) <span class="required">*</span></label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                           id="price" name="price" required step="0.01" min="0"
                           placeholder="e.g., 45.99" value="{{ old('price') }}">
                    <div class="form-text">Enter the price in Ghana Cedis</div>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Product Photo -->
                <div class="mb-4">
                    <label class="form-label">Product Photo <span class="required">*</span></label>
                    <div class="image-upload" onclick="document.getElementById('photo').click()">
                        <div class="image-upload-icon">📷</div>
                        <div class="image-upload-text">
                            <strong>Click to upload product photo</strong><br>
                            <small>PNG, JPG or JPEG (Max 2MB)</small>
                        </div>
                    </div>
                    <input type="file" class="form-control d-none @error('photo') is-invalid @enderror" 
                           id="photo" name="photo" accept="image/*" required onchange="previewImage(this)">
                    <div class="image-preview" id="imagePreview">
                        <img id="preview" src="" alt="Preview">
                    </div>
                    @error('photo')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contact Number -->
                <div class="mb-4">
                    <label for="contact_number" class="form-label">Contact Number <span class="required">*</span></label>
                    <input type="tel" class="form-control @error('contact_number') is-invalid @enderror" 
                           id="contact_number" name="contact_number" required 
                           placeholder="e.g., 0501234567" value="{{ old('contact_number') }}">
                    <div class="form-text">Customer will use this number to contact you</div>
                    @error('contact_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Location -->
                <div class="mb-4">
                    <label for="location" class="form-label">Location <span class="required">*</span></label>
                    <input type="text" class="form-control @error('location') is-invalid @enderror" 
                           id="location" name="location" required 
                           placeholder="e.g., Accra, Osu" value="{{ old('location') }}">
                    <div class="form-text">Where customers can find/collect the product</div>
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="form-label">Description <span class="required">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" required 
                              placeholder="Describe your product, its features, benefits, and any other important details...">{{ old('description') }}</textarea>
                    <div class="form-text">Provide detailed information about the product</div>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Add Product</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>