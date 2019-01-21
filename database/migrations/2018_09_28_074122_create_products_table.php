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
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->increments('id');
            $table->string('name', 255)->index()->nullable(false);
            $table->string('articul', 255)->index()->unique();
            $table->string('description', 255)->nullable();
            $table->float('cost', 12, 2)->default('0.00');
            $table->integer('page_id')->index();
            $table->integer('currency_id')->index();
            // $table->foreign('currency_id')->references('id')->on('currencies');
            $table->integer('vendor_id')->index();
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
        Schema::dropIfExists('products');
    }
}
