@extends('layouts.app')

@section('title', 'Not Found')

@section('content_body')
<div class="text-center mt-5">
    <h1 class="display-1">404</h1>
    <p class="lead">Oops! Page not found.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
</div>
@endsection