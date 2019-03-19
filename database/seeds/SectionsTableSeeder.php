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
            for ($i = 0; $i < 255; $i++) {
                $ip = App\Ip::create([
                    "id_seccion" => $u->id,
                    "codigo_final" => $i,
                    "estado" => 1,
                ]);
                $u->ips()->save($ip)->make();
            }
        });
    }
}
