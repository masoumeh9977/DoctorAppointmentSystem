@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email">
        </div>

        @error('email')
            <div>
                <p class="alert alert-danger" role="alert">{{ $message }}</p>
            </div>
        @enderror

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}"
                placeholder="Enter Password">
        </div>

        @error('password')
            <div>
                <p class="alert alert-danger" role="alert">{{ $message }}</p>
            </div>
        @enderror

        <button type="submit" class="btn btn-block btn-primary">Login</button>
    </form>
@endsection
