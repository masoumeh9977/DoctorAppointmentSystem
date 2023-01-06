@extends('layouts.dashboard-layout')
@section('title', 'Edit Schedule')
@section('content')
    <div class="container card-ml">
        <h3>Doctor Schedule</h3>
        <div class="card">
            <div class="card-header">
                Edit Schedule
            </div>
            <div class="card-body">
                <form action="{{ route('schedule.update', ['schedule' => $schedule->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3 row">
                        <label for="date" class="form-label col-2">Date *</label>
                        <input class="form-control col-4" type="date" id="date" name="date"
                            value="{{ $schedule->date }}">
                    </div>
                    @error('date')
                        <div class="{{ $errors->has('date') ? 'invalid-error-message' : '' }}">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="input-group mb-3 row">
                        <label for="time_from" class="form-label col-2">Start Time *</label>
                        <input class="form-control col-4" type="time" id="time_from" name="time_from"
                            value="{{ $schedule->time_from }}">
                    </div>
                    @error('time_from')
                        <div class="{{ $errors->has('time_from') ? 'invalid-error-message' : '' }}">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="input-group mb-3 row">
                        <label for="time_to" class="form-label col-2">End Time *</label>
                        <input class="form-control col-4" type="time" id="time_to" name="time_to"
                            value="{{ $schedule->time_to }}">
                    </div>
                    @error('time_to')
                        <div class="{{ $errors->has('time_to') ? 'invalid-error-message' : '' }}">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3 row">
                                <label for="capacity" class="form-label col-4">Capacity *</label>
                                <input class="form-control col-2" type="number" id="capacity" name="capacity"
                                    value="{{ $schedule->capacity }}">
                            </div>
                            @error('capacity')
                                <div class="{{ $errors->has('capacity') ? 'invalid-error-message' : '' }}">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="is_available" id="is_available"
                                    {{ $schedule->is_available ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_available">
                                    Available
                                </label>
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>

@endsection
