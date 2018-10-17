<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'user',
            'lastname' => 'demo',
            'email' => 'user@demo.com',
            'nickname' => 'demo',
            'password' => bcrypt('demo')
        ]);
    }
}
