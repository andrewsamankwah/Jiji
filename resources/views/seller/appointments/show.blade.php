<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details - Jiji Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Jiji Beauty</a>
            <div class="ms-auto">
                <a href="{{ route('appointments.manage') }}" class="btn btn-outline-secondary">← Back to Appointments</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1>Appointment Details</h1>
                
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Appointment #{{ $appointment->id }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Customer Information</h6>
                                <p><strong>Name:</strong> {{ $appointment->customer_name }}</p>
                                <p><strong>Email:</strong> {{ $appointment->customer_email }}</p>
                                <p><strong>Phone:</strong> {{ $appointment->customer_phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Service Details</h6>
                                <p><strong>Service:</strong> {{ $appointment->service->name }}</p>
                                <p><strong>Date & Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M j, Y - g:i A') }}</p>
                                <p><strong>Duration:</strong> {{ $appointment->duration }} minutes</p>
                                <p><strong>Price:</strong> GH₵{{ number_format($appointment->price, 2) }}</p>
                                <p><strong>Status:</strong> 
                                    <span class="badge 
                                        @if($appointment->status == 'pending') bg-warning
                                        @elseif($appointment->status == 'confirmed') bg-success
                                        @elseif($appointment->status == 'completed') bg-info
                                        @else bg-danger @endif">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        @if($appointment->notes)
                        <div class="row mt-3">
                            <div class="col-12">
                                <h6>Customer Notes</h6>
                                <div class="alert alert-light">
                                    {{ $appointment->notes }}
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6>Manage Appointment</h6>
                                <div class="btn-group" role="group">
                                    @if($appointment->status == 'pending')
                                    <form action="{{ route('appointments.update-status', $appointment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="btn btn-success me-2">Confirm Appointment</button>
                                    </form>
                                    <form action="{{ route('appointments.update-status', $appointment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-danger">Cancel Appointment</button>
                                    </form>
                                    @endif
                                    
                                    @if($appointment->status == 'confirmed')
                                    <form action="{{ route('appointments.update-status', $appointment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="btn btn-primary me-2">Mark as Completed</button>
                                    </form>
                                    <form action="{{ route('appointments.update-status', $appointment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-danger">Cancel Appointment</button>
                                    </form>
                                    @endif

                                    @if(in_array($appointment->status, ['completed', 'cancelled']))
                                    <form action="{{ route('appointments.update-status', $appointment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="pending">
                                        <button type="submit" class="btn btn-warning">Reopen Appointment</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast show" role="alert">
            <div class="toast-header bg-success text-white">
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>