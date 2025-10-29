@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="container mt-5">
    <h1>Welcome to Your Dashboard, {{ Auth::user()->name }}!</h1>
    <p>You are logged in as a regular user.</p>
</div>
@endsection
