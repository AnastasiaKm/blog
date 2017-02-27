<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1,50) as $index)
        {
          User::create([
            'name' => $faker->word . $index,
            'email' => $faker->email,
            'password' => 'secret'
          ]);
        }
    }
}
