<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
{
return [
'titre' => fake()->words(2, true),
'description' => fake()->sentence(),
'prix' => fake()->numberBetween(5000, 50000),
'duree' => fake()->numberBetween(15, 90),
'statut' => 'actif',
'medecin_id' => null,
];
}
}
