<?php

namespace Database\Factories;

use App\Models\colocations;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MembershipsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 25),
            'colocation_id' => fake()->numberBetween(1, 25),
            'role' => 'member',
            'owner_id' => fake()->numberBetween(1, 25),
            'joined_at' => fake()->dateTimeBetween('-6 months', 'now'),
            'left_at' => null,
        ];
    }
}
