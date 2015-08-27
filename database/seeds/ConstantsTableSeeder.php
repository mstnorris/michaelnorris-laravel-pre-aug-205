<?php

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

use App\Article;
use App\User;

class ConstantsTableSeeder extends Seeder
{
    public function run()
    {

        $faker = Faker::create('en_US');

        /*
         * Base User Accounts
         */

        // Mike's account
        $michael = User::create([
            'name'       => 'Michael Norris',
            'email'      => 'mstnorris@gmail.com',
            'password'   => bcrypt('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        factory(App\Article::class, 50)->create();

        factory(App\Tag::class, 20)->create();


    }
}
