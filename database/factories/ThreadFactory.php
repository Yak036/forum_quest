<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thread>
 */
class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // ? aqui configuras el category id directamente desde los seeders
            'user_id'=> User::all()->random()->id,
            'title'=> fake()->sentence(),
            'body'=> fake()->text(),
        ];
    }
}