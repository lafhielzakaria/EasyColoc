<?php

namespace Database\Factories;

use App\Models\colocations;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettlementsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'expenses_id' => fake()->numberBetween(1, 25),
            'debtor_id' => fake()->numberBetween(1, 25),
            'creditor_id' =>fake()->numberBetween(1, 25),
            'amount' => fake()->randomFloat(2, 10, 200),
            'is_paid' => fake()->boolean(50),
        ];
    }
}
