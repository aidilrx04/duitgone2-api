<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $min = -25;
        $max = 25;

        return [
            'amount' => fake()->randomFloat(2, $min, $max),
            'date' => fake()->dateTimeBetween('today', 'now')
        ];
    }
}
