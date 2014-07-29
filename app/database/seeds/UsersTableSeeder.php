<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
        DB::table('users')->delete();

        $users = array(
            array(
                'id'         => 1,
                'name'       => 'Cliente',
                'username'   => 'cliente',
                'email'      => 'cliente@test.io',
                'password'   => Hash::make('cliente'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                ),
            array(
                'id'         => 2,
                'name'       => 'Empresa',
                'username'   => 'empresa',
                'email'      => 'empresa@test.io',
                'password'   => Hash::make('empresa'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                )
            );

        DB::table('users')->insert($users);

    }

}