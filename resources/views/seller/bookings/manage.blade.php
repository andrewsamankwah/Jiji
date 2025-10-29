<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings - Jiji Beauty</title>
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
        <h1>Manage Bookings</h1>
        
        <div class="alert alert-info">
            <h4>Bookings Management</h4>
            <p>This is where you can manage all your customer bookings and appointments.</p>
            <a href="{{ route('appointments.manage') }}" class="btn btn-primary">View Appointments</a>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h3>15</h3>
                        <p>Pending Bookings</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h3>8</h3>
                        <p>Confirmed</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h3>22</h3>
                        <p>Completed</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h3>2</h3>
                        <p>Cancelled</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>