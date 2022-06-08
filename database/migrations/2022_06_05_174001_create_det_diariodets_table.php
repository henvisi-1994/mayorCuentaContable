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
        Schema::create('DET_DIARIODET', function (Blueprint $table) {
            $table->integer('CC_SEQMOV')->comment('foranea');
            $table->text('CC_DETALLE')->comment('Contiene El detalle de la transacción');
            $table->timestamps();
            $table->primary('CC_SEQMOV');
            $table->foreign('CC_SEQMOV')->references('CC_SEQMOV')->on('DET_DIARIO');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DET_DIARIODET');
    }
};
