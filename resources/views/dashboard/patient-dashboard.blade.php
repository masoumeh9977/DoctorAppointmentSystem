@extends('layouts.dashboard-layout')
@section('title', 'Dashboard')
@section('content')
    <div class="container card-ml">
        <h3>Doctor's Schedule</h3>
        <div class="card">
            <div class="card-body">
                @if (count($schedules))
                    <p>This is Doctor's Schedule. Please Select Your Appointment.</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Date</th>
                                <th scope="col">Start Time</th>
                                <th scope="col">End Time</th>
                                <th scope="col">Book</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $key => $schedule)
                                @if ($schedule->is_available)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $schedule->date }}</td>
                                        <td>{{ $schedule->time_from }}</td>
                                        <td>{{ $schedule->time_to }}</td>
                                        <td>
                                            <a href="{{ route('appointment.create', ['scheduleId' => $schedule->id]) }}"
                                                type="button"
                                                class="btn btn-outline-primary {{ $schedule->appointment_count > $schedule->capacity ? 'disabled' : '' }}">
                                                {{ $schedule->appointment_count > $schedule->capacity ? 'The Capacity is Full!' : 'Book' }}

                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div>
                        <p class="alert alert-danger" role="alert">Doctor is Not Available at this Moment! Please Try
                            Again
                            Later!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
