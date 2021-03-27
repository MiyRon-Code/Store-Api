<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(40),
            'description' => $this->faker->text(120),
            'price' =>$this->faker->numberBetween(1,1000),
            'category_id' =>$this->faker->numberBetween(1,10),
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}
