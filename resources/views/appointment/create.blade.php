@extends('layouts.dashboard-layout')
@section('title', 'Create Appointment')
@section('content')
    <div class="container card-ml">
        <h3>Appointment</h3>
        <div class="card">
            <div class="card-header">
                Patient Information
            </div>
            <div class="card-body">
                <ul>
                    <li>Patient Name: {{ $user->name . ' ' . $user->lastname }}</li>
                    <li>Phone Number: {{ $user->phone_no }}</li>
                    <li>Address: {{ $user->address }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container card-ml mt-3">

        <div class="card">
            <div class="card-header">
                Appointment Information
            </div>
            <div class="card-body">
                <ul>
                    <li>Date: {{ $schedule->date }}</li>
                    <li>Time: {{ $schedule->time_from . ' - ' . $schedule->time_to }}</li>
                </ul>
                <form class="mt-5" action="{{ route('appointment.store', ['scheduleId' => $schedule->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="input-group mb-3 row">
                        <label for="time_from" class="form-label col-2">Start Time *</label>
                        <input class="form-control col-4" type="time" id="time_from" name="time_from"
                            value="{{ old('time_from') }}">
                    </div>
                    @error('time_from')
                        <div class="invalid-error-message">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="input-group mb-3 row">
                        <label for="time_to" class="form-label col-2">End Time *</label>
                        <input class="form-control col-4" type="time" id="time_to" name="time_to"
                            value="{{ old('time_to') }}">
                    </div>
                    @error('time_to')
                        <div class="invalid-error-message">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="input-group mb-3 row">
                        <label for="symptom_image" class="form-label col-2">Image</label>
                        <input type="file" class="form-control-file" id="symptom_image" name="symptom_image" />
                    </div>
                    @error('symptom_image')
                        <div class="invalid-error-message">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="form-group mb-3 row">
                        <label for="patient_symptom" class="form-label col-2">Symptom *</label>
                        <textarea class="form-control" id="patient_symptom" rows="3" name="patient_symptom"></textarea>
                    </div>
                    @error('patient_symptom')
                        <div class="invalid-error-message">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="form-group mb-3 row">
                        <label for="patient_comment" class="form-label col-2">Comment *</label>
                        <textarea class="form-control" rows="3" name="patient_comment"></textarea>
                    </div>
                    @error('patient_comment')
                        <div class="invalid-error-message">
                            {{ $message }}
                        </div>
                    @enderror

                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
