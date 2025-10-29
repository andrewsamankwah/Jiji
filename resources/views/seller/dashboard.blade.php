<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard - Jiji Beauty</title>
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

        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
        }

        .btn-logout:hover {
            background: white;
            color: #667eea;
        }

        .dashboard-container {
            padding: 40px 20px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .welcome-section {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .welcome-section h1 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .welcome-section p {
            color: #666;
            font-size: 1.1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card.products {
            border-left: 5px solid #667eea;
        }

        .stat-card.services {
            border-left: 5px solid #f093fb;
        }

        .stat-card.bookings {
            border-left: 5px solid #48c6ef;
        }

        .stat-card.completed {
            border-left: 5px solid #4CAF50;
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin: 10px 0;
        }

        .stat-label {
            color: #666;
            font-size: 0.95rem;
        }

        .action-section {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .action-section h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .action-btn {
            padding: 20px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .action-btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .action-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            color: white;
        }

        .action-btn-secondary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .action-btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(240, 147, 251, 0.3);
            color: white;
        }

        .action-btn-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
        }

        .action-btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(56, 239, 125, 0.3);
            color: white;
        }

        .action-btn-info {
            background: linear-gradient(135deg, #48c6ef 0%, #6f86d6 100%);
            color: white;
        }

        .action-btn-info:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(72, 198, 239, 0.3);
            color: white;
        }

        .btn-icon {
            font-size: 2rem;
        }

        .recent-section {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .recent-section h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: #f8f9fa;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 6px;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Jiji Beauty</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('seller.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">View Store</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-logout">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="dashboard-container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1>Welcome back, {{ Auth::user()->name }}! 👋</h1>
            <p>Here's what's happening with your store today</p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card products">
                <div class="stat-icon">📦</div>
                <div class="stat-number">{{ $totalProducts }}</div>
                <div class="stat-label">Total Products</div>
            </div>
            <div class="stat-card services">
                <div class="stat-icon">💆‍♀️</div>
                <div class="stat-number">{{ $totalServices }}</div>
                <div class="stat-label">Active Services</div>
            </div>
            <div class="stat-card bookings">
                <div class="stat-icon">📅</div>
                <div class="stat-number">{{ $pendingAppointments }}</div>
                <div class="stat-label">Pending Bookings</div>
            </div>
            <div class="stat-card completed">
                <div class="stat-icon">✅</div>
                <div class="stat-number">{{ $completedAppointments }}</div>
                <div class="stat-label">Completed Services</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="action-section">
            <h2>Quick Actions</h2>
            <div class="action-buttons">
                <a href="{{ route('products.create') }}" class="action-btn action-btn-primary">
                    <span class="btn-icon">➕</span>
                    <span>Add New Product</span>
                </a>
                <a href="{{ route('services.create') }}" class="action-btn action-btn-secondary">
                    <span class="btn-icon">✨</span>
                    <span>Add New Service</span>
                </a>
                <a href="{{ route('products.manage') }}" class="action-btn action-btn-success">
                    <span class="btn-icon">📋</span>
                    <span>Manage Products</span>
                </a>
                <a href="{{ route('appointments.manage') }}" class="action-btn action-btn-info">
                    <span class="btn-icon">📆</span>
                    <span>Manage Bookings</span>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="recent-section">
            <h2>Recent Bookings</h2>
            @if($recentAppointments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Customer</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th>Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentAppointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->service->name ?? 'N/A' }}</td>
                                    <td>{{ $appointment->customer_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M j, Y - g:i A') }}</td>
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
                                        <small>{{ $appointment->customer_phone }}</small>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <p class="text-muted">No recent bookings yet.</p>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>