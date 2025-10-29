@extends('layouts.app')

@section('title', $service->name . ' - Jiji Beauty')

@section('content')
<style>
    .service-details-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .service-details-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .service-image-section {
        padding: 0;
        position: relative;
    }

    .service-image {
        width: 100%;
        height: 400px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 8rem;
    }

    .service-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .service-info-section {
        padding: 40px;
    }

    .service-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .service-category {
        color: #667eea;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .service-description {
        color: #666;
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .provider-info {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 30px;
    }

    .provider-info h4 {
        color: #333;
        margin-bottom: 15px;
        font-size: 1.2rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        color: #666;
    }

    .info-item i {
        color: #667eea;
        margin-right: 10px;
        width: 20px;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .btn-primary, .btn-secondary {
        padding: 15px 30px;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        flex: 1;
        justify-content: center;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(240, 147, 251, 0.3);
        color: white;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        flex: 1;
        justify-content: center;
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        color: white;
    }

    .guest-message {
        background: #fff3cd;
        border: 1px solid #ffeaa7;
        border-radius: 10px;
        padding: 20px;
        margin-top: 30px;
        text-align: center;
        color: #856404;
    }

    .guest-message a {
        color: #667eea;
        font-weight: 600;
        text-decoration: none;
    }

    .guest-message a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .service-title {
            font-size: 2rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-primary, .btn-secondary {
            flex: none;
        }
    }
</style>

<div class="service-details-container">
    <div class="service-details-card">
        <div class="row g-0">
            <!-- Service Image -->
            <div class="col-md-6 service-image-section">
                <div class="service-image">
                    @if($service->photo)
                        <img src="{{ asset('storage/' . $service->photo) }}" alt="{{ $service->name }}">
                    @else
                        <div>💆‍♀️</div>
                    @endif
                </div>
            </div>
            
            <!-- Service Information -->
            <div class="col-md-6 service-info-section">
                <div class="service-category">{{ $service->category }}</div>
                <h1 class="service-title">{{ $service->name }}</h1>
                
                <div class="service-description">
                    {{ $service->description }}
                </div>

                <!-- Provider Information -->
                <div class="provider-info">
                    <h4>👨‍💼 Service Provider</h4>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <span>{{ $service->contact_number }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $service->location }}</span>
                    </div>
                    @if($service->user)
                    <div class="info-item">
                        <i class="fas fa-user-tie"></i>
                        <span>Provided by: {{ $service->user->name }}</span>
                    </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    @auth
                        <a href="{{ route('book') }}?service_id={{ $service->id }}" class="btn-primary">
                            <i class="fas fa-calendar-check"></i>
                            Book Appointment
                        </a>
                    @else
                        <a href="{{ route('login') }}?message=Login to book {{ $service->name }}" class="btn-primary">
                            <i class="fas fa-calendar-check"></i>
                            Book Appointment
                        </a>
                    @endauth
                    
                    <a href="{{ route('welcome') }}" class="btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Back to Home
                    </a>
                </div>

                @guest
                <div class="guest-message">
                    🔐 <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register.user') }}">Sign up</a> to book appointments with our professional service providers.
                </div>
                @endguest
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection