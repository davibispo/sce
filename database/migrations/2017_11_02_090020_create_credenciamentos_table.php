<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCredenciamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credenciamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('digital');
            $table->string('nome', 60);
            $table->bigInteger('cpf');
            $table->text('foto')->nullable();
            $table->integer('funcionario_id');
            $table->string('empresa',200);
            $table->string('evento',300);
            $table->integer('evento_id');
            $table->foreign('evento_id')->references('id')->on('eventos');
            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->char('presente', 1)->nullable()->default('0');
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
        Schema::dropIfExists('credenciamentos');
    }
}
