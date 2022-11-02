<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'in_menu' => rand(0, 1),
            // 'description' => $faker->realText(300),
        ];
    }
}
