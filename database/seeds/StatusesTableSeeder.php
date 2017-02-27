<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Status;
use App\Models\User;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = User::lists('id');

        foreach(range(1,50) as $index)
        {
          Status::create([
            'user_id' => $faker->randomElement($users)
            'body' => $faker->sentence()
          ]);
        }
    }
}
