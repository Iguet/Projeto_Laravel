<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('projeto_id');
            $table->unsignedBigInteger('user_id');
            $table->string('titulo')->unique();
            $table->text('descricao');
            $table->enum('estado', ['nova', 'em progresso', 'parada', 'finalizada']);
            $table->foreign('projeto_id')->references('id')->on('projetos');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('demandas');
    }
}
