<?php

namespace Database\Factories;

use App\Models\Practice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PracticeFactory extends Factory
{
    protected $model = Practice::class;

    public function definition(): array
    {
        return [
            'trainer_id' => User::factory(),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->optional()->sentence(),
            'capacity' => $this->faker->numberBetween(5, 30),
            'date_time' => $this->faker->dateTimeBetween('now', '+1 month'),
            'duration' => $this->faker->numberBetween(30, 120),
        ];
    }
}
