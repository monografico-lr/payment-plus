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
        DB::table('servicios')->insert(
            [
                'nombre' => 'Plan Basico',
                'descripcion' => 'Un Plan basico de ejemplo',
                'mensualidad' => 800,
                'tipo' => '1',
            ],
            [
                'nombre' => 'Plan Plata',
                'descripcion' => 'Un Plan basico de ejemplo',
                'mensualidad' => 1200,
                'tipo' => '1',
            ],
            [
                'nombre' => 'Plan Oro',
                'descripcion' => 'Un Plan basico de ejemplo',
                'mensualidad' => 2400,
                'tipo' => '1',
            ]
        );
    }
}
