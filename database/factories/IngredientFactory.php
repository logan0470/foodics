<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fakeQuantiry = fake()->numberBetween(1, 50);
        return [
            'ingredient' => fake()->unique()->name,
            'quantity' => $fakeQuantiry,
            'base_quantity' => $fakeQuantiry * 3
        ];
    }
}
