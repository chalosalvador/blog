<?php

namespace Database\Seeders;

use App\Article;
use App\User;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla articles.
        Article::truncate();
        $faker = \Faker\Factory::create();

        // Obtenemos la lista de todos los usuarios creados e
        // iteramos sobre cada uno y simulamos un inicio de
        // sesión con cada uno para crear artículos en su nombre
        $users = \App\User::all();
        $image_name = $faker->image('public/storage/articles', 400, 300, null, false);

        foreach ($users as $user) {
            // iniciamos sesión con este usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);

            // Y ahora con este usuario creamos algunos articulos
            $num_articles = 5;
            for ($j = 0; $j < $num_articles; $j++) {
                Article::create([
                    'title' => $faker->sentence,
                    'body' => $faker->paragraph,
                    'category_id' => $faker->numberBetween(1, 3),
                    'image' => 'articles/' . $image_name
                ]);
            }
        }
    }
}
