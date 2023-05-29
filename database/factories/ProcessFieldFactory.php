<?php

namespace Database\Factories;

use App\Models\ProcessField;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProcessField>
 */
class ProcessFieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->realText(50),
            'type' => ProcessField::TYPES[rand(0, 3)],
        ];
    }
}
