<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductSku;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSku>
 */
class ProductSkuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ProductSku::class;

    public function definition(): array
    {
        return [
            'title'       => $this->faker->word,
            'description' => $this->faker->sentence,
            'price'       => $this->faker->randomNumber(4),
            'stock'       => $this->faker->randomNumber(5),
        ];
    }
}
