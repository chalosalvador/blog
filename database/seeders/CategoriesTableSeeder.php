<?php

namespace Database\Seeders;

use App\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        // Vaciamos la tabla categories
        Category::truncate();
        $faker = Factory::create();

        for ($i = 0; $i < 3; $i++) {
            Category::create([
                'name' => $faker->word]);
        }
    }
}
