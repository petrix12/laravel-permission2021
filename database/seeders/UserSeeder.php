<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
            NOTA: En producción dejar solo los datos del adiministrador inicial (y establecer un password seguro
            desde la aplicación) y comentar la creación de los 99 usuarios de prueba.
        */
        $user = User::create([
            'name' => 'Pedro Jesús Bazó Canelón',
            'email' => 'bazo.pedro@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole('Admin');
        User::factory(99)->create();
    }
}
