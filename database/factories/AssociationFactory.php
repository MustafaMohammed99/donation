<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Association>
 */
class AssociationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'email' => $this->faker->safeEmail,
            'password' => Hash::make('password'),
            'image_path' => 'uploads/associations/GJhq7hHkCxQ6SodhiRHZJZOcIw0lqG9EGW8CiudZ.jpg',
        ];
    }
}
