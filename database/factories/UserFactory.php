<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$J0SHHnSGta9elxlImNHa..jTcdmbz8A6n2MnhmtJUPu5NSNQt/v3C', // password
            'remember_token' => Str::random(10),
            'is_admin' => fake()->boolean(0),
            'profile_pic' => fake()->imageUrl(),
            'dob' => fake()->dateTimeBetween('-60 years', '-20 years')->format('d-m-Y')
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
