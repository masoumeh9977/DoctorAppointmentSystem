@extends('layouts.dashboard-layout')
@section('title', 'Create Schedule')
@section('content')
    <div class="container card-ml">
        <h3>Doctor Schedule</h3>
        <div class="card">
            <div class="card-header">
                Add Schedule
            </div>
            <div class="card-body">
                <form action="{{ route('schedule.store') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3 row">
                        <label for="date" class="form-label col-2">Date *</label>
                        <input class="form-control col-4" type="date" id="date" name="date"
                            value="{{ old('date') }}">
                    </div>
                    @error('date')
                        <div class="{{ $errors->has('date') ? 'invalid-error-message' : '' }}">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="input-group mb-3 row">
                        <label for="time_from" class="form-label col-2">Start Time *</label>
                        <input class="form-control col-4" type="time" id="time_from" name="time_from"
                            value="{{ old('time_from') }}">
                    </div>
                    @error('time_from')
                        <div class="{{ $errors->has('time_from') ? 'invalid-error-message' : '' }}">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="input-group mb-3 row">
                        <label for="time_to" class="form-label col-2">End Time *</label>
                        <input class="form-control col-4" type="time" id="time_to" name="time_to"
                            value="{{ old('time_to') }}">
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
                                    value="{{ old('capacity') }}">
                            </div>
                            @error('capacity')
                                <div class="{{ $errors->has('capacity') ? 'invalid-error-message' : '' }}">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="is_available" id="is_available">
                                <label class="form-check-label" for="is_available">
                                    Available
                                </label>
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container card-ml mt-3">
        <div class="card">
            <div class="card-header">
                Doctor's Schedule Table
            </div>
            <div class="card-body">
                <div>
                    @if (count($schedules))
                        <p>This is Doctor's Schedule. Please Login To Make An Appointment.</p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Availability</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $key => $schedule)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $schedule->date }}</td>
                                        <td>{{ $schedule->time_from }}</td>
                                        <td>{{ $schedule->time_to }}</td>
                                        <td>{{ $schedule->is_available ? 'available' : 'not available' }} </td>
                                        <td><a href="{{ route('schedule.edit', ['schedule' => $schedule->id]) }}"
                                                type="button" class="btn btn-outline-primary">Edit</a></td>
                                        <td>
                                            <form action="{{ route('schedule.destroy', ['schedule' => $schedule->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input class="btn btn-outline-danger" type="submit" value="Delete" />
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div>
                            <p class="alert alert-danger" role="alert">Empty!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection
