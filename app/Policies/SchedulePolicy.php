<?php

namespace App\Policies;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchedulePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->is_doctor;
    }

    public function create(User $user)
    {
        return $user->is_doctor;
    }

    public function update(User $user, Schedule $schedule)
    {
        return $user->is_doctor;
    }

    public function delete(User $user, Schedule $schedule)
    {
        return $user->is_doctor;
    }
}
