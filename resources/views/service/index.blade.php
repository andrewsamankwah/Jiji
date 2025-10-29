@extends('layouts.app')

@section('title', 'Our Services')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Our Services</h1>
    <div class="row text-center">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm">
                <h5>Hair Styling</h5>
                <p>Professional haircuts and styling for all occasions.</p>
                <!-- BOOK NOW BUTTON -->
                <a href="{{ route('book') }}" 
                   class="btn btn-primary mt-2" 
                   style="background: #ff69b4; border-color: #ff69b4; color: white;">
                   📅 Book Appointment
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm">
                <h5>Professional Makeup</h5>
                <p>Flawless looks for weddings, events, and photoshoots.</p>
                <!-- BOOK NOW BUTTON -->
                <a href="{{ route('book') }}" 
                   class="btn btn-primary mt-2" 
                   style="background: #ff69b4; border-color: #ff69b4; color: white;">
                   📅 Book Appointment
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm">
                <h5>Manicure</h5>
                <p>Delicate nail care with elegant polish finishes.</p>
                <!-- BOOK NOW BUTTON -->
                <a href="{{ route('book') }}" 
                   class="btn btn-primary mt-2" 
                   style="background: #ff69b4; border-color: #ff69b4; color: white;">
                   📅 Book Appointment
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm">
                <h5>Pedicure</h5>
                <p>Relaxing pedicure treatments to keep your feet soft and fresh.</p>
                <!-- BOOK NOW BUTTON -->
                <a href="{{ route('book') }}" 
                   class="btn btn-primary mt-2" 
                   style="background: #ff69b4; border-color: #ff69b4; color: white;">
                   📅 Book Appointment
                </a>
            </div>
        </div>
    </div>
</div>
@endsection