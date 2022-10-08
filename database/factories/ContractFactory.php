<?php

namespace Database\Factories;

use App\Models\Category;
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
            'category_id' => Category::first()->id,
            'name' => $faker->name,
            'description' => $faker->randomHtml(10),
            'text' => $faker->realText(3000),
            'price' => $faker->randomElement([1000, 2000, 3000]),
        ];
    }
}
