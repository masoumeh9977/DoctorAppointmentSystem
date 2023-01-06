<?php

namespace Database\Factories;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    public function definition()
    {
        return [
            'date' => $this->faker->date('Y-m-d'),
            'time_from' => $this->faker->time('H:i'),
            'time_to' => $this->faker->time('H:i'),
            'capacity' => $this->faker->randomDigit(),
            'is_available' => $this->faker->boolean()
        ];
    }
}
