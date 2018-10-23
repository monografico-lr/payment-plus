<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('servicios')->insert([
            'nombre' => 'Plan Basico',
            'descripcion' => 'Un Plan basico de ejemplo',
            'mensualidad' => 800,
            'tipo' => '1',
        ]);
    }
}
