<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service - Jiji Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Jiji Beauty</a>
            <div class="ms-auto">
                <a href="{{ route('services.manage') }}" class="btn btn-outline-secondary">← Back to Services</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Edit Service</h4>
                    </div>
                    <div class="card-body">
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

                        <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Service Name *</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $service->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category *</label>
                                <select class="form-select" name="category" required>
                                    <option value="Hair Styling" {{ $service->category == 'Hair Styling' ? 'selected' : '' }}>Hair Styling</option>
                                    <option value="Makeup" {{ $service->category == 'Makeup' ? 'selected' : '' }}>Makeup</option>
                                    <option value="Manicure & Pedicure" {{ $service->category == 'Manicure & Pedicure' ? 'selected' : '' }}>Manicure & Pedicure</option>
                                    <option value="Facial Treatment" {{ $service->category == 'Facial Treatment' ? 'selected' : '' }}>Facial Treatment</option>
                                    <option value="Massage" {{ $service->category == 'Massage' ? 'selected' : '' }}>Massage</option>
                                    <option value="Spa Services" {{ $service->category == 'Spa Services' ? 'selected' : '' }}>Spa Services</option>
                                    <option value="Braiding" {{ $service->category == 'Braiding' ? 'selected' : '' }}>Braiding</option>
                                    <option value="Waxing" {{ $service->category == 'Waxing' ? 'selected' : '' }}>Waxing</option>
                                    <option value="Other" {{ $service->category == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Current Photo</label>
                                @if($service->photo)
                                    <div>
                                        <img src="{{ asset('storage/' . $service->photo) }}" alt="Current Service Photo" class="img-fluid mb-2" style="max-height: 200px;">
                                    </div>
                                @else
                                    <p class="text-muted">No photo uploaded</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Update Photo (Optional)</label>
                                <input type="file" class="form-control" name="photo" accept="image/*">
                                <small class="text-muted">Leave empty to keep current photo</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Contact Number *</label>
                                <input type="tel" class="form-control" name="contact_number" value="{{ old('contact_number', $service->contact_number) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Location *</label>
                                <input type="text" class="form-control" name="location" value="{{ old('location', $service->location) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="active" {{ $service->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $service->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description *</label>
                                <textarea class="form-control" name="description" rows="4" required>{{ old('description', $service->description) }}</textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Update Service</button>
                                <a href="{{ route('services.manage') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>