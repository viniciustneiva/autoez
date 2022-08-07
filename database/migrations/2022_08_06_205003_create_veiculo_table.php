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
        Schema::create('veiculo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('placa',8)->unique();
            $table->integer('marca_id')->unsigned();
            $table->foreign('marca_id')->references('id')->on('marca')->restrictOnDelete();
            $table->string('modelo');
            $table->string('cor');
            $table->string('ano', 4);
            $table->string('valor');
            $table->tinyInteger('disponivel')->default(1);
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
        Schema::dropIfExists('veiculo');
    }
};
