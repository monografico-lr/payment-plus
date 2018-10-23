<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresas')->insert([
            'rnc' => '',
            'nombre' => 'IC Services',
            'logo' => '',
            'lema' => 'LA RED QUE TE CONECTA CON LOS TUYOS.',
            'direccion' => 'C/ Bienvenido Creales No.94, Centro Ciudad. Edif. EuroPlaza',
            'telefono1' => '8098131111',
            'telefonos' => '8297483990'
        ]);
    }
}
