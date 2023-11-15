<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition(): array
    {

        $image = $this->faker->randomElement([
            "http://localhost/storage/images/1.jpg",
            "http://localhost/storage/images/2.jpg",
            "http://localhost/storage/images/3.jpg",
            "http://localhost/storage/images/4.jpg",
            "http://localhost/storage/images/5.jpg",
            "http://localhost/storage/images/6.jpg",
            "http://localhost/storage/images/7.jpg",
        ]);

        return [
            'title'        => $this->faker->word,
            'description'  => $this->faker->sentence,
            'image'        => $image,
            'on_sale'      => true,
            'rating'       => $this->faker->numberBetween(0, 5),
            'sold_count'   => 0,
            'review_count' => 0,
            'price'        => 0,
        ];
    }
}
