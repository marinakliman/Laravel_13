<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku'=> $this->faker->word(),
            'name'=> $this->faker->sentence(1),
            'price'=> $this->faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 1000)
        ];
    }
}
