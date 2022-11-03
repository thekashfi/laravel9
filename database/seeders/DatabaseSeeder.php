<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contract;
use App\Models\File;
use App\Models\Package;
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
        User::factory(1)->admin()->create() && User::factory(9)->create();

        Category::factory(5)->create();

        Contract::factory(5)->create();

        File::create([
            'category_id' => Category::first()->id,
            'name' => 'foo',
            'description' => '<p>description for testing</p>',
            'file' => '/storage/private/1.jpg',
            'slug' => 'foo',
            'price' => 1000,
            'is_active' => 1]);
        File::create([
            'category_id' => Category::first()->id,
            'name' => 'bar',
            'description' => '<p>description for testing</p>',
            'file' => '/storage/private/2.jpg',
            'slug' => 'bar',
            'price' => 2000,
            'is_active' => 1]);

        $this->create_package('foo');
        $this->create_package('bar');
        $this->create_package('baz');
        $this->create_package('qux');
        $this->create_package('quux');
    }

    private function create_package($name)
    {
        $package = Package::create([
            'category_id' => Category::first()->id,
            'name' => $name,
            'description' => '<p>description for testing</p>',
            'slug' => str_replace(' ', '_', $name) . rand(1, 1000),
            'price' => 3000,
            'is_active' => 1]);
        $package->contracts()->sync(Contract::limit(2)->pluck('id'));
        $package->files()->sync(File::first()->id);
    }
}
