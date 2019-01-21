<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_deliveries', function (Blueprint $table) {
          $table->engine = 'InnoDB';
          $table->charset = 'utf8mb4';
          $table->collation = 'utf8mb4_general_ci';
          $table->increments('id');
          $table->integer('delivery_id')->index();
          $table->string('user_name', 255)->index();
          $table->string('user_surname', 255)->index();
          $table->string('user_email', 255)->index();
          $table->string('user_phone', 255)->index();
          $table->string('user_adress', 255);
          $table->string('delivery_name', 255)->index();
          $table->float('cost', 12, 2)->default('0.00');
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
        Schema::dropIfExists('orders_deliveries');
    }
}
