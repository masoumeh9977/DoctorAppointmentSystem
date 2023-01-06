<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return !$user->is_doctor;
    }

    public function update(User $user, Appointment $appointment)
    {
        return ($user->is_doctor || $user->id === $appointment->user_id);
    }

    public function delete(User $user, Appointment $appointment)
    {
        return ($user->is_doctor || $user->id === $appointment->user_id);
    }
}
