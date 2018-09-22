<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAveriassTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('averias', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('id_cliente');
			$table->integer('id_contrato');
			$table->text('descripcion');
			$table->date('fecha_reparacion');
			$table->integer('estado')->comment('valores: por reparar, reparado'); // por reparar, reparado
			$table->char('tecnico', 100);
			$table->softDeletes();
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
		Schema::dropIfExists('averias');
	}
}
