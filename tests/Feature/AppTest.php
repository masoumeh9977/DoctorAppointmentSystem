<?php

namespace Tests\Feature;

use App\Models\Schedule;
use App\Models\User;
use Tests\TestCase;

class AppTest extends TestCase
{

    //for testing the dashboard view of corresponding user and authentication
    public function test_patient_dashboard_view()
    {
        $this->actingAs($this->createDummyUser())
            ->get(route('dashboard'))
            ->assertViewIs('dashboard.patient-dashboard');
    }

    public function test_create_new_schedule()
    {
        $user = $this->createDummyUser();
        $user->is_doctor = true;

        $schedule = $this->createDummySchedule();

        $this->actingAs($user)
            ->post('schedule.store')
            ->assertSeeText($schedule->capacity);
        $this->assertDatabaseHas('schedules', [
            'created_at' => $schedule->created_at
        ]);
    }

    public function createDummyUser()
    {
        /** @var User */
        $user = User::factory()->create();
        return $user;
    }
    public function createDummySchedule()
    {
        return Schedule::factory()->create();
    }
}
