<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::connection('pgsql_security')->create('tAdmins', function (Blueprint $table) {
          $table->increments('idAdmin');
          $table->string('loginAdmin')->unique();
          $table->string('emailAdmin')->unique();
          $table->string('claveAdmin');
          $table->integer('statusAdmin')->default(1);
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
      Schema::connection('pgsql_security')->dropIfExists('tAdmins');
    }
}
