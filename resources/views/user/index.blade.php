@extends('layouts.dashboard-layout')
@section('title', 'Profile')
@section('content')

    <div class="container card-ml">
        <div class="card">
            <div class="card-header">
                Patient List
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Fullname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Status</th>
                            <th scope="col">Dob</th>
                            <th scope="col">Address</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <th scope="row">{{ $key  }}</th>
                                <td>{{ $user->name . ' ' . $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_no }}</td>
                                <td>{{ $user->gender == 0 ? 'Male' : 'Female' }} </td>
                                <td>{{ $user->status == 0 ? 'Single' : 'Married' }} </td>
                                <td>{{ $user->dob }}</td>
                                <td>{{ $user->address }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
