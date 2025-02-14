<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::inRandomOrder()->first()->id ?? Client::factory(),
            'description' => $this->faker->sentence,
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
