<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_pages', function (Blueprint $table) {
          $table->engine = 'InnoDB';
          $table->charset = 'utf8mb4';
          $table->collation = 'utf8mb4_general_ci';
          $table->increments('id');
          $table->integer('product_id')->index();
          // $table->foreign('product_id')->references('id')->on('products');
          $table->integer('page_id')->index();
          // $table->foreign('page_id')->references('id')->on('pages');


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
        Schema::dropIfExists('products_pages');
    }
}
