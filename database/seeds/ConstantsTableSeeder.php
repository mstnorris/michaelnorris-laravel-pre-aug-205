<?php

use App\Tag;
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

        $articleIds = Article::lists('id')->all();
        $tagIds = Tag::lists('id')->all();

        foreach ( range ( 1, 30 ) as $index )
        {
            DB::table('article_tag')->insert([
                'article_id' => $faker->randomElement($articleIds),
                'tag_id' => $faker->randomElement($tagIds)
            ]);
        }


    }
}
