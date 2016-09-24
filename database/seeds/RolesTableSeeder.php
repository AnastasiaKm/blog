<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
          'name' => 'admin',
        ]);

        DB::table('roles')->insert([
          'name' => 'author',
        ]);

        DB::table('roles')->insert([
          'name' => 'subscriber',
        ]);

        DB::table('users')->insert([
          'name' => 'Anastasia Km',
          'role_id' => 1,
          'is_active' => 1,
          'email' => 'a.karamichailidou@gmail.com',
          'password' => bcrypt('123456'),
        ]);

    }
}
