<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service - Jiji Beauty</title>
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
            border-color: #f093fb;
            box-shadow: 0 0 0 0.2rem rgba(240, 147, 251, 0.25);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .image-upload {
            border: 3px dashed #f093fb;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #fff5fc;
        }

        .image-upload:hover {
            background: #ffe8f7;
            border-color: #f5576c;
        }

        .image-upload-icon {
            font-size: 3rem;
            color: #f093fb;
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
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
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
            box-shadow: 0 10px 20px rgba(240, 147, 251, 0.4);
            background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
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
                <h1>Add New Service</h1>
                <p>Fill in the details below to list your service</p>
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

            <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Service Name -->
                <div class="mb-4">
                    <label for="name" class="form-label">Service Name <span class="required">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" required 
                           placeholder="e.g., Professional Hair Styling" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-4">
                    <label for="category" class="form-label">Service Category <span class="required">*</span></label>
                    <select class="form-select @error('category') is-invalid @enderror" 
                            id="category" name="category" required>
                        <option value="">Select a category</option>
                        <option value="Hair Styling" {{ old('category') == 'Hair Styling' ? 'selected' : '' }}>Hair Styling</option>
                        <option value="Makeup" {{ old('category') == 'Makeup' ? 'selected' : '' }}>Makeup</option>
                        <option value="Manicure & Pedicure" {{ old('category') == 'Manicure & Pedicure' ? 'selected' : '' }}>Manicure & Pedicure</option>
                        <option value="Facial Treatment" {{ old('category') == 'Facial Treatment' ? 'selected' : '' }}>Facial Treatment</option>
                        <option value="Massage" {{ old('category') == 'Massage' ? 'selected' : '' }}>Massage</option>
                        <option value="Spa Services" {{ old('category') == 'Spa Services' ? 'selected' : '' }}>Spa Services</option>
                        <option value="Braiding" {{ old('category') == 'Braiding' ? 'selected' : '' }}>Braiding</option>
                        <option value="Waxing" {{ old('category') == 'Waxing' ? 'selected' : '' }}>Waxing</option>
                        <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Service Photo -->
                <div class="mb-4">
                    <label class="form-label">Service Photo <span class="required">*</span></label>
                    <div class="image-upload" onclick="document.getElementById('photo').click()">
                        <div class="image-upload-icon">📸</div>
                        <div class="image-upload-text">
                            <strong>Click to upload service photo</strong><br>
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
                    <div class="form-text">Customers will use this number to book appointments</div>
                    @error('contact_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Location -->
                <div class="mb-4">
                    <label for="location" class="form-label">Location <span class="required">*</span></label>
                    <input type="text" class="form-control @error('location') is-invalid @enderror" 
                           id="location" name="location" required 
                           placeholder="e.g., Accra, East Legon" value="{{ old('location') }}">
                    <div class="form-text">Where the service will be provided</div>
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="form-label">Description <span class="required">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" required 
                              placeholder="Describe your service, what's included, any requirements, and other important details...">{{ old('description') }}</textarea>
                    <div class="form-text">Provide detailed information about the service</div>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Add Service</button>
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