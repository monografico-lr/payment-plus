<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCajaMayorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caja_mayor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario');
            $table->decimal('pagos_facturas', 11, 2);
            $table->decimal('pagos_extras', 11, 2);
            $table->decimal('pagos_efectivo', 11, 2);
            $table->decimal('pagos_banco', 11, 2);
            $table->decimal('total_ingresos', 11, 2);
            $table->decimal('efectivo_caja', 11, 2);
            $table->decimal('total_descuadre', 11, 2);
            $table->decimal('total_gastos', 11, 2);
            $table->decimal('banco', 11, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caja_mayor');
    }
}
