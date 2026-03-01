<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BansFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 25),
            'banned_by' => 1,
            'reason' => fake()->sentence(),
            'banned_at' => now(),
            'unbanned_at' => null,
        ];
    }
}
