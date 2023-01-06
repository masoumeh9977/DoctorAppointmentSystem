@extends('layouts.email')
@section('content')
    <div class="alert alert-success" role="alert">
        Your Appointment is Registered.
    </div>

    <div class="container card-ml">
        <h3>Appointment</h3>
        <div class="card">
            <div class="card-header">
                Patient Information
            </div>
            <div class="card-body">
                <ul>
                    <li>Patient Name: {{ $appointment->user->name . ' ' . $appointment->user->lastname }}</li>
                    <li>Phone Number: {{ $appointment->user->phone_no }}</li>
                    <li>Address: {{ $appointment->user->address }}</li>
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
                    <li>Date: {{ $appointment->schedule->date }}</li>
                    <li>Time: {{ $appointment->schedule->time_from . ' - ' . $appointment->schedule->time_to }}</li>
                    <li>Start Time: {{ $appointment->time_from }}</li>
                    <li>End Time: {{ $appointment->time_to }}</li>
                    <li>Symptom:
                        <p>{{ $appointment->patient_symptom }}</p>
                    </li>
                    <li>Comment:
                        <p>{{ $appointment->patient_comment }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
