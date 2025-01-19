<?php

namespace Database\Factories;

use App\Models\Progress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Progress>
 */
class ProgressFactory extends Factory
{
    protected $model = Progress::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween('-6 months', 'now');
        
        return [
            'weight' => $this->faker->randomFloat(2, 5, 100),
            'reps' => $this->faker->numberBetween(5, 15),
            'notes' => $this->faker->optional()->sentence(),
            'date' => $date,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
