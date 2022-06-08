<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TMA_PLANCTA', function (Blueprint $table) {
            $table->integer('CC_SEQCTA')->autoIncrement()->comment('autoincrementable');
            $table->integer('CC_NIVEL1')->comment('indica el tipo de cuenta a la que pertenece ');
            $table->integer('CC_NIVEL2')->comment('Grupo principal del plan de cuentas ');
            $table->integer('CC_NIVEL3')->comment('Subgrupo1 del plan de cuentas');
            $table->string('CC_NIVEL4')->comment('Subgrupo2 del plan de cuentas');
            $table->string('CC_NIVEL5')->comment('Subgrupo3 del plan de cuentas');
            $table->string('CC_NIVEL6')->comment('Subgrupo4 del plan de cuentas');
            $table->string('CC_AUXILIAR')->comment('Cuenta de Movimiento');
            $table->string('CC_CTAMOV')->comment('Cuenta de Movimiento');
            $table->date('CC_FECAPE')->comment('Fecha de Apertura');
            $table->text('CC_NOMBRE')->comment('Descripción de la Cuenta Contable');
            $table->integer('CC_TIPCTA')->comment('Tipo de Cuenta');
            $table->char('CC_CLASE',1)->comment('Clase de Cuenta');
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
        Schema::dropIfExists('TMA_PLANCTA');
    }
};
