<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //random string code
            'code' => fake()->unique()->randomNumber(8),
            'status' => fake()->randomElement(['pending', 'success', 'cancle']),
            'note' => fake()->sentence(),
            'merchant_id' => Merchant::all()->random()->id,
            'customer_id' => Customer::all()->random()->id,
        ]; 
    }
}
