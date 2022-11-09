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
            'name' => $faker->word,
            'slug' => $this->faker->unique()->word,
            'description' => $faker->randomHtml(10),
            'summary' => $faker->realText(300),
            'text' => $faker->realText(3000),
            'price' => $faker->randomElement([1000, 2000, 3000]),
        ];
    }
}
