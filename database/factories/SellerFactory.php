<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seller::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'mail' => $this->faker->unique()->email,
            'address' => $this->faker->unique()->address,
            'phone_number' => $this->faker->unique()->phoneNumber,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
