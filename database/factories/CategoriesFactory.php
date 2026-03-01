<?php

namespace Database\Factories;

use App\Models\colocations;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriesFactory extends Factory
{
    public function definition(): array
    {
        return [
            'colocation_id' =>  fake()->numberBetween(1, 25),
            'name' => fake()->randomElement(['Groceries', 'Rent', 'Utilities', 'Internet', 'Cleaning', 'Furniture']),
            'description' => fake()->sentence(),
        ];
    }
}
