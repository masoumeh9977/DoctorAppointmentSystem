@extends('layouts.dashboard-layout')
@section('title', 'Appointments')
@section('content')
    <div class="container card-ml">
        <div class="card">
            <div class="card-header">
                Your Appointments
            </div>
            <div class="card-body">
                @if (count($appointments))
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                @if (Auth::user()->is_doctor)
                                    <th scope="col">Patient Name</th>
                                @endif
                                <th scope="col">Date</th>
                                <th scope="col">Start Time</th>
                                <th scope="col">End Time</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                                @if (Auth::user()->is_doctor)
                                    <th scope="col">Complete</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $key => $appointment)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    @if (Auth::user()->is_doctor)
                                        <td>{{ $appointment->user->name . ' ' . $appointment->user->lastname }}</td>
                                    @endif
                                    <td>{{ $appointment->schedule->date }}</td>
                                    <td>{{ $appointment->time_from }}</td>
                                    <td>{{ $appointment->time_to }}</td>
                                    <td><a href="{{ route('appointment.edit', ['appointment' => $appointment->id]) }}"
                                            type="button"
                                            class="btn btn-outline-primary {{ $appointment->is_completed == 'false' ? 'disabled' : '' }}">Edit</a>
                                    </td>
                                    <td>
                                        <form
                                            action="{{ route('appointment.destroy', ['appointment' => $appointment->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-outline-danger" type="submit" value="Delete" />
                                        </form>
                                    </td>
                                    @if (Auth::user()->is_doctor)
                                        <td>
                                            @if (!$appointment->is_completed)
                                                <form
                                                    action="{{ route('appointment.update', ['appointment' => $appointment->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="checkbox" value="1" name="is_completed" checked
                                                        style="display: none;" />
                                                    <button class="btn btn-outline-success" type="submit">Complete</button>
                                                </form>
                                            @else
                                                <button type="button" class="btn btn-outline-success"
                                                    disabled>Completed</button>
                                            @endif

                                        </td>
                                    @endif
                                </tr>
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
