<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date_reservation' => fake()->dateTimeBetween('+1 day', '+1 month'),
            'heure_reservation' => fake()->time(),
            'statut' => 'en_attente',
            'commentaire' => fake()->sentence(),
        ];
    }
}
