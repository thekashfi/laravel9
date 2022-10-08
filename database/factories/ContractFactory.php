<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('fa_IR');
        return [
            'name' => $faker->word,
            'description' => $faker->paragraph,
            'price' => $faker->randomElement([1000, 2000, 3000]),
        ];
    }
}
