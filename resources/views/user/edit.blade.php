@extends('layouts.dashboard-layout')
@section('title', 'Profile')
@section('content')

    <div class="container card-ml">
        <div class="card">
            <div class="card-header">
                User Profile
            </div>
            <div class="card-body">
                <form class="mt-5" action="{{ route('user.update', ['id' => $user->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if (isset($user->image->src))
                        <div class="row justify-content-center mb-3">
                            <div class="col-4">
                                <img src="{{ Storage::url($user->image->src) }}" class="card-img-top" alt="profile pic"
                                    style="width: 250px;height: 250px;">
                            </div>
                        </div>
                    @else
                        <div class="mb-3">
                            <label for="profile_img" class="form-label">Profile Image</label>
                            <input class="form-control" type="file" id="profile_img" name="profile_img">
                        </div>
                    @endif

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->name }}"
                                name="name">
                        </div>
                        @error('name')
                            <div class="{{ $errors->has('date') ? 'invalid-error-message' : '' }}">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="col">
                            <label for="lastname" class="form-label">Lastname</label>
                            <input type="text" class="form-control" id="lastname" value="{{ $user->lastname }}"
                                name="lastname">
                        </div>
                        @error('lastname')
                            <div class="{{ $errors->has('date') ? 'invalid-error-message' : '' }}">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}"
                                name="email">
                        </div>
                        @error('email')
                            <div class="{{ $errors->has('date') ? 'invalid-error-message' : '' }}">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="col">
                            <label for="phone_no" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_no" value="{{ $user->phone_no }}"
                                name="phone_no">
                        </div>
                        @error('phone_no')
                            <div class="{{ $errors->has('date') ? 'invalid-error-message' : '' }}">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" name="address">{{ $user->address }}</textarea>
                    </div>
                    @error('address')
                        <div class="{{ $errors->has('date') ? 'invalid-error-message' : '' }}">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" class="form-select" name="gender">
                                <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>Male</option>
                                <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        @error('gender')
                            <div class="{{ $errors->has('date') ? 'invalid-error-message' : '' }}">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="col">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" class="form-select" name="status">
                                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Single</option>
                                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Married</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="{{ $errors->has('date') ? 'invalid-error-message' : '' }}">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>

@endsection
