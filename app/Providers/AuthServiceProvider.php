<?php

namespace App\Providers;

use App\Models\Schedule;
use App\Models\User;
use App\Policies\SchedulePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Schedule' => 'App\Policies\SchedulePolicy',
        'App\Models\Appointment' => 'App\Policies\AppointmentPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('user.view', function (User $user) {           
            return $user->is_doctor;
        });
        Gate::define('user.edit', function (User $user, User $targetUser) {
            return $user->id === $targetUser->id;
        });
    }
}
