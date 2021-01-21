<?php

namespace Database\Seeders;

use App\Admin;
use App\Category;
use App\User;
use App\Writer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla
        User::truncate();

        $faker = \Faker\Factory::create();

        // Crear la misma clave para todos los usuarios
        // conviene hacerlo antes del for para que el seeder
        // no se vuelva lento.
        $password = Hash::make('123123');

        $admin = Admin::create(['credential_number' => '0987654321']);
        $admin->user()->create([
            'name' => 'Administrador',
            'email' => 'admin@prueba.com',
            'password' => $password,
            'role' => 'ROLE_ADMIN'
        ]);

        // Generar algunos usuarios para nuestra aplicacion
        for ($i = 0; $i < 10; $i++) {
            $writer = Writer::create([
                'editorial' => $faker->company,
                'short_bio'=> $faker->paragraph
            ]);

            $writer->user()->create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
            ]);

            $writer->user->categories()->saveMany(
                $faker->randomElements(
                    array(
                        Category::find(1),
                        Category::find(2),
                        Category::find(3)
                    ), $faker->numberBetween(1, 3), false)
            );
        }
    }
}
