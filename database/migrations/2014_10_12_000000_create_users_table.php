<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::connection('pgsql_security')->create('tUsuarios', function (Blueprint $table) {
          $table->increments('idUsuario');
          $table->string('loginUsuario')->unique();
          $table->string('emailUsuario')->unique();
          $table->string('claveUsuario');
          $table->integer('statusUsuario')->default(1);
          $table->rememberToken();
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
        Schema::connection('pgsql_security')->dropIfExists('tUsuarios');
    }
}
