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
        Schema::create('DET_DIARIO', function (Blueprint $table) {
            $table->integer('CC_SEQMOV')->autoIncrement()->comment('autoincrementable');
            $table->integer('CC_SEQCTA')->comment('foranea de TMA_PLANCTA ');
            $table->integer('CC_NUMCOM')->comment('Identifica el numero del diario contable');
            $table->date('CC_FECMOV')->comment('Identifica la Fecha de la transacción');
            $table->char('CC_TIPOPE',1)->comment('Tipo de Movimiento');
            $table->double('CC_VALOR')->comment('Valor de la Transacción');
            $table->string('LOGIN', 50)->comment('Usuario que realizo la transacción');
            $table->string('CC_ANIOMES', 6)->comment('Año y Mes de la transacción');
            $table->timestamps();
            $table->foreign('CC_SEQCTA')->references('CC_SEQCTA')->on('TMA_PLANCTA');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DET_DIARIO');
    }
};
