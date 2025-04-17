@extends('layouts.app')

@section('title', 'Internal Server Error')

@section('content_body')
<div class="text-center mt-5">
    <h1 class="display-1">500</h1>
    <p class="lead">Oops! Something went wrong on our end.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
</div>
@endsection