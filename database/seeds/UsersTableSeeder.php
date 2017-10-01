<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'uuid' => uniqid('admin_'),
            'role' => 'admin',
            'email' => 'mytepper@gmail.com',
            'password' => bcrypt('mytepper@gmail.com')
        ]);
    }
}
