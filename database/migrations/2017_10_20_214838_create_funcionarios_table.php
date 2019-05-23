<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 60);
            $table->string('endereco', 200);
            $table->integer('endereco_num');
            $table->string('bairro', 80);
            $table->bigInteger('telefone');
            $table->string('email', 100)->nullable();
            $table->char('sexo', 1);
            $table->date('dt_nasc');
            $table->bigInteger('cpf');
            $table->integer('pis')->nullable();    
            $table->bigInteger('rg')->nullable();    
            $table->text('foto')->nullable();
            $table->text('digital');
            $table->string('empresa', 200);
            $table->date('dt_admis')->nullable();
            $table->string('cargo')->nullable();
            $table->string('salario', 9)->nullable();
            $table->string('uf',40);
            $table->string('cidade',60);
            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->char('status', 1)->nullable()->default('1');
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
        Schema::dropIfExists('funcionarios');
    }
}
