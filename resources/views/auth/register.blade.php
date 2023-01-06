@extends('layouts.app')
@section('title', 'SignUp')
@section('content')
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Name">
        </div>

        @error('name')
            <div>
                <p class="alert alert-danger" role="alert">{{ $message }}</p>
            </div>
        @enderror

        <div class="form-group">
            <label for="lastname">Lastname</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}"
                placeholder="Enter Lastname">
        </div>

        @error('lastname')
            <div>
                <p class="alert alert-danger" role="alert">{{ $message }}</p>
            </div>
        @enderror

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

        <button type="submit" class="btn btn-block btn-primary">Submit</button>
    </form>
@endsection
