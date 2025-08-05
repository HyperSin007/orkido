<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'passport_number' => fake()->unique()->regexify('[A-Z]{2}[0-9]{6}'),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'gpa' => fake()->randomFloat(2, 2.0, 4.0),
            'ielts_score' => fake()->optional(0.8)->randomFloat(1, 5.0, 9.0),
        ];
    }
}
