<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsermodulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_security')->create('tUserModules', function (Blueprint $table) {
            $table->increments('idUserModule');
            $table->integer('idUser')->unsigned();
            $table->integer('idModule')->unsigned();
            $table->timestamps();
            $table->foreign('idUser')->references('idUsuario')->on('tUsuarios');
            $table->foreign('idModule')->references('idModule')->on('tModules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_security')->dropIfExists('tUserModules');
    }
}
