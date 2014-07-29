<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
        DB::table('users')->delete();
        $faker = Faker::create();

        foreach(range(1, 15) as $index)
        {
            $user = User::create(array(
                'name'     => $faker->firstName.' '.$faker->lastName,
                'username' => $faker->userName,
                'email'    => $faker->email,
                'password' => Hash::make($faker->word),
                ));
        }

        User::create(array(
            'name'     => 'Chris Sevilleja',
            'username' => 'sevilayha',
            'email'    => 'chris@scotch.io',
            'password' => Hash::make('awesome'),
            ));

    }

}