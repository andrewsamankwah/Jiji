@extends('layouts.app')

@section('title', 'Seller Dashboard')

@section('content')
<div class="container mt-5">
    <h1>Welcome to Your Seller Dashboard, {{ Auth::user()->name }}!</h1>
    <p>Business: {{ Auth::user()->business_name }}</p>
</div>
@endsection