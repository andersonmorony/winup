<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificacaoCurtidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacao_curtidas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('curtida_id')->unsigned();
            $table->boolean('notificacao_visualizada')->nullable();
            $table->foreign('curtida_id')->references('id')->on('curtirs')->onDelete('cascade')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notificacao_curtidas');
    }
}
