<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Joueur>
 */
class JoueurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->name("male"),
            "numero" => fake()->numberBetween(1,99),
            "age" => fake()->numberBetween(15,40),
            "nationalité" => fake()->country,
            "equipe_id" => 8,
            "post" => "Attaquant",
            "but_equipe" => fake()->numberBetween(0,1000),
            "but_selection" => fake()->numberBetween(0,1000),
        ];
    }
}
