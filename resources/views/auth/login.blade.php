<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Jiji Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        .login-container {
            max-width: 450px;
            width: 100%;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
        }

        .login-header h1 {
            color: #ff69b4;
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .login-header p {
            color: white;
            margin: 10px 0 0 0;
            font-size: 1rem;
        }

        .login-body {
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
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        .forgot-password {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .forgot-password:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .register-section {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 2px solid #e0e0e0;
        }

        .register-title {
            text-align: center;
            color: #333;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 1.1rem;
        }

        .register-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .btn-register {
            padding: 15px 20px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .btn-register-user {
            background: linear-gradient(135deg, #48c6ef 0%, #6f86d6 100%);
            color: white;
            border: none;
        }

        .btn-register-user:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(72, 198, 239, 0.4);
            color: white;
        }

        .btn-register-seller {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: none;
        }

        .btn-register-seller:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(240, 147, 251, 0.4);
            color: white;
        }

        .register-icon {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>Jiji Beauty</h1>
                <p>Welcome back! Please sign in</p>
            </div>
            <div class="login-body">
                <!-- Display Laravel validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> {{ $errors->first() }}
                    </div>
                @endif

                <!-- Display success messages -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
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
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required 
                               placeholder="Enter your password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                        <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn btn-login">Sign In</button>
                </form>

                <div class="register-section">
                    <p class="register-title">Don't have an account? Register as:</p>
                    <div class="register-buttons">
                        <a href="{{ route('register.user') }}" class="btn-register btn-register-user">
                            <span class="register-icon">👤</span>
                            <span>Customer</span>
                        </a>
                        <a href="{{ route('register.seller') }}" class="btn-register btn-register-seller">
                            <span class="register-icon">🏪</span>
                            <span>Seller</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>