<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration - Jiji Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            padding: 40px 20px;
        }

        .register-container {
            max-width: 500px;
            width: 100%;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .register-header {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            padding: 40px 30px;
            text-align: center;
        }

        .register-header h1 {
            color: white;
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
        }

        .register-icon {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .register-header p {
            color: rgba(255, 255, 255, 0.9);
            margin: 10px 0 0 0;
            font-size: 1rem;
        }

        .register-body {
            padding: 40px 30px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #f093fb;
            box-shadow: 0 0 0 0.2rem rgba(240, 147, 251, 0.25);
        }

        .btn-register {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            padding: 12px;
            font-size: 1.1rem;
            width: 100%;
            margin-top: 20px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(240, 147, 251, 0.4);
            background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        .login-link a {
            color: #f093fb;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            color: #f5576c;
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .password-requirements {
            font-size: 0.85rem;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <div class="register-icon">🏪</div>
                <h1>Seller Registration</h1>
                <p>Start selling on Jiji Beauty</p>
            </div>
            <div class="register-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Please fix the errors below.
                    </div>
                @endif

                <form action="{{ route('register.seller') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" required 
                               placeholder="Enter your full name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" required 
                               placeholder="Enter your email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" required 
                               placeholder="Enter your phone number" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="shop_name" class="form-label">Shop/Business Name</label>
                        <input type="text" class="form-control @error('shop_name') is-invalid @enderror" 
                               id="shop_name" name="shop_name" required 
                               placeholder="Enter your shop name" value="{{ old('shop_name') }}">
                        @error('shop_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required 
                               placeholder="Create a password">
                        <div class="password-requirements">Minimum 8 characters</div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation" required 
                               placeholder="Confirm your password">
                    </div>

                    <button type="submit" class="btn btn-register">Create Seller Account</button>
                </form>

                <div class="login-link">
                    Already have an account? <a href="{{ route('login') }}">Sign in here</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>