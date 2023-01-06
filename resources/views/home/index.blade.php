@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <div class="row d-flex align-items-center">

        <div class="col-6">
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div>
                    <p class="alert alert-danger" role="alert">Doctor is Not Available at this Moment! Please Try Again
                        Later!</p>
                </div>
            @endif
        </div>
        <div class="col-6">
            <img class="w-100 h-100" src="{{ asset('img/MedicalPrescription.png') }}" />
        </div>
    </div>
@endsection
