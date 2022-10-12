<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        Category::factory(10)->create();
        Contract::factory(10)->create();
    }
}
