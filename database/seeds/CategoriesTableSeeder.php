<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciamos la tabla categories
        Category::truncate();
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 3; $i++) {
            Category::create([
                'name' => $faker->word]);
        }
    }
}
