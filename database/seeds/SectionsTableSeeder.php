<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Section::class, 3)->create()->each(function ($u) {
            $u->ips()->save(factory(App\Ip::class)->make());
        });
    }
}
