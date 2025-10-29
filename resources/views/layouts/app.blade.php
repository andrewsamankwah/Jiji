<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jiji Beauty')</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
     
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Fix layout issues */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f5f7fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navbar Styling - WHITE BACKGROUND */
        .navbar {
            background: white !important;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1000;
            flex-shrink: 0;
        }

        .navbar-brand {
            color: #ff69b4 !important;
            font-weight: 700;
            font-size: 1.8rem;
        }

        .hamburger-menu {
            border: 2px solid #667eea;
            background: white;
            font-size: 1.5rem;
            padding: 0.5rem 1rem;
            color: #667eea;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .hamburger-menu:hover {
            background: #667eea;
            color: white;
        }

        .dropdown-menu-lg {
            min-width: 250px;
        }

        .nav-divider {
            border-top: 1px solid #dee2e6;
            margin: 0.5rem 0;
        }

        .navbar-brand-centered {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .nav-link {
            color: #333 !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #ff69b4 !important;
        }

        main {
            flex: 1;
            margin-top: 0;
            padding-top: 0;
        }

        /* User dropdown */
        #userDropdown {
            color: #333 !important;
            font-weight: 600;
        }

        /* Dropdown submenu styling */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -1px;
            display: none;
        }

        .dropdown-submenu:hover .dropdown-menu {
            display: block;
        }

        /* Login/Register links styling */
        .nav-auth-links .nav-link {
            color: #667eea !important;
            font-weight: 600;
        }

        .nav-auth-links .nav-link:hover {
            color: #ff69b4 !important;
        }

        .nav-separator {
            color: #ddd;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container position-relative">
            <!-- Hamburger Menu -->
            <div class="d-flex align-items-center">
                <button class="hamburger-menu" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ☰
                </button>
                <ul class="dropdown-menu dropdown-menu-lg">
                    <!-- Products Dropdown -->
<li class="dropdown-submenu">
    <a class="dropdown-item dropdown-toggle" href="#">Products</a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('search') }}?q=creams">Creams</a></li>
        <li><a class="dropdown-item" href="{{ route('search') }}?q=perfumes">Perfumes</a></li>
        <li><a class="dropdown-item" href="{{ route('search') }}?q=oral care">Oral Care</a></li>
        <li><a class="dropdown-item" href="{{ route('search') }}?q=makeup">Makeup</a></li>
        <li><a class="dropdown-item" href="{{ route('search') }}?q=hair">Hair</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="{{ route('products.all') }}">All Products</a></li>
    </ul>
</li>

<!-- Services Dropdown -->
<li class="dropdown-submenu">
    <a class="dropdown-item dropdown-toggle" href="#">Services</a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('search') }}?q=hair styling">Hair Styling</a></li>
        <li><a class="dropdown-item" href="{{ route('search') }}?q=professional makeup">Professional Makeup</a></li>
        <li><a class="dropdown-item" href="{{ route('search') }}?q=manicure">Manicure</a></li>
        <li><a class="dropdown-item" href="{{ route('search') }}?q=pedicure">Pedicure</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="{{ route('services.index') }}">All Services</a></li>
    </ul>
</li>
                    
                    <li><a class="dropdown-item" href="{{ route('book') }}">📅 Book Appointment</a></li>
                    <div class="nav-divider"></div>
                    <li><a class="dropdown-item" href="#">About Us</a></li>
                    <li><a class="dropdown-item" href="#">Contact</a></li>
                </ul>
            </div>

            <!-- Brand name - Centered -->
            <a class="navbar-brand fw-bold navbar-brand-centered" href="{{ route('home') }}">
                Jiji Beauty
            </a>

            <!-- Right side items -->
            <div class="d-flex align-items-center ms-auto nav-auth-links">
                @guest
                    <!-- Guest: Login and Register -->
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    <span class="nav-separator">|</span>
                    <a class="nav-link" href="{{ route('register.user') }}">Sign Up</a>
                @else
                    <!-- Logged-in: User Profile -->
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            👤 {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('home') }}">🏠 Home</a></li>
                            <li><a class="dropdown-item" href="#">📦 My Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('book') }}">📅 My Appointments</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        🚪 Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <main>
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enable nested dropdowns
        document.querySelectorAll('.dropdown-submenu a.dropdown-toggle').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const submenu = this.nextElementSibling;
                if (submenu) {
                    submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
                }
            });
        });

        // Close submenus when clicking elsewhere
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown-submenu')) {
                document.querySelectorAll('.dropdown-submenu .dropdown-menu').forEach(function(submenu) {
                    submenu.style.display = 'none';
                });
            }
        });
    </script>
</body>
</html>