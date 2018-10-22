<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario');
            $table->integer('id_cliente');
            $table->integer('id_servicio');
            $table->string('codigo', 6);
            $table->date('fecha');
            $table->integer('duracion');
            $table->integer('estado')->comment('activo, saldado, cancelado, mora, suspendido')->default(1);
            $table->string('nombre_equipo', 50);
            $table->macAddress('mac_equipo');
            $table->string('modelo', 50);
            $table->string('router', 50);
            $table->macAddress('mac_router');
            $table->ipAddress('ip');
            $table->boolean('instalado');
            $table->text('observaciones');
            $table->date('fecha_suspencion');
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
        Schema::dropIfExists('contratos');
    }
}
