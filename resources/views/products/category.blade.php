@extends('layouts.app')

@section('title', 'Products - Jiji Beauty')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h1>{{ $categoryName ?? 'All Products' }}</h1>
            <p>Products in this category will be displayed here soon!</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
</div>
@endsection