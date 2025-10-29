<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointments - Jiji Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Jiji Beauty</a>
            <div class="ms-auto">
                <a href="{{ route('seller.dashboard') }}" class="btn btn-outline-secondary">← Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Manage Appointments</h1>
        
        @if($appointments->isEmpty())
            <div class="alert alert-info">
                No appointments yet.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Date & Time</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->customer_name }}</td>
                                <td>{{ $appointment->service->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M j, Y - g:i A') }}</td>
                                <td>
                                    {{ $appointment->customer_phone }}<br>
                                    {{ $appointment->customer_email }}
                                </td>
                                <td>
                                    <span class="badge 
                                        @if($appointment->status == 'pending') bg-warning
                                        @elseif($appointment->status == 'confirmed') bg-success
                                        @elseif($appointment->status == 'completed') bg-info
                                        @else bg-danger @endif">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                               </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>
</html>