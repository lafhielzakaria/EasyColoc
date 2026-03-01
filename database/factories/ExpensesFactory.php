<?php

namespace Database\Factories;

use App\Models\categories;
use App\Models\colocations;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpensesFactory extends Factory
{
    public function definition(): array
    {
        return [
            'colocation_id' => fake()->numberBetween(1, 25),
            'category_id' => fake()->numberBetween(1, 25),
            'created_by' => fake()->numberBetween(1, 25),
            'title' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'amount' => fake()->randomFloat(2, 10, 500),
            'date' => fake()->dateTimeBetween('-3 months', 'now'),
            'is_paid' => fake()->boolean(80),
        ];
    }
}
