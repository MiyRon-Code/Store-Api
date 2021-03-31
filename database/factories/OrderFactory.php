<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_id =  $this->faker->numberBetween(1,50);
        $product_id = $this->faker->unique()->numberBetween(1, 100);
        return [
            'code' =>hash('crc32b', $product_id.$user_id.now()),
            'product_id' => $product_id,
            'user_id' =>  $user_id,
            'confirmed' => $this->faker->boolean(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
