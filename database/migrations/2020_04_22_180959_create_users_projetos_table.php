<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_projetos', function (Blueprint $table) {
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('projetos_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('projetos_id')->references('id')->on('projetos');
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
        Schema::dropIfExists('users_projetos');
    }
}
