@extends('adminlte::page')

@section('title', 'Account Settings')

@section('content_header')
<h1>Account Settings</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Profile Info</h3>
            </div>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input id="name" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ old('email', auth()->user()->email) }}">
                    </div>
                    <div class="form-group">
                        <label for="password">New Password <small>(leave blank to keep current)</small></label>
                        <input id="password" name="password" type="password" class="form-control">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop