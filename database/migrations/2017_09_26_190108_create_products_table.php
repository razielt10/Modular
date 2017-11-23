<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::connection('pgsql_inventory')->create('tProducts', function (Blueprint $table) {
            $table->increments('idProduct');
            $table->timestamps();
            $table->string('nameProduct');
            $table->integer('idCategorie')->unsigned();
            $table->foreign('idCategorie')->references('idCategorie')->on('tCategories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_inventory')->dropIfExists('tProducts');
    }
}
