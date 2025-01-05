<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'id_number' => fake()->unique()->randomNumber(8),
            'nationality' => fake()->country(),
            'email' => fake()->unique()->safeEmail(),
            'date_of_birth' => fake()->date(),
            'password' => static::$password ??= Hash::make('password'),
            'facebook' => fake()->url(),
            'instagram' => fake()->url(),
            'twitter' => fake()->url(),
            'tiktok' => fake()->url(),
            'personal_page' => fake()->url(),
            'description' => '<p>' . fake()->text() . '</p>',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role' => 'user'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
