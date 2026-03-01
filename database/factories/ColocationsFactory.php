<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColocationsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'address' => fake()->address(),
            'owner_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'status' => 'active',
        ];
    }
}
