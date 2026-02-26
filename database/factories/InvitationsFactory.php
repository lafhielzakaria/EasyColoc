<?php

namespace Database\Factories;

use App\Models\colocations;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InvitationsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'colocation_id' => fake()->numberBetween(1, 25),
            'invited_by' => fake()->numberBetween(1, 25),
            'email' => fake()->unique()->safeEmail(),
            'token' => Str::random(10),
            'status' => fake()->randomElement(['pending', 'accepted', 'rejected']),
            'accepted_at' => null,
        ];
    }
}
