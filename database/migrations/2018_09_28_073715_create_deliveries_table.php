<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
          $table->engine = 'InnoDB';
          $table->charset = 'utf8mb4';
          $table->collation = 'utf8mb4_general_ci';
          $table->increments('id');
          $table->string('name')->index()->nullable(false);
          $table->string('description')->nullable();
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
        Schema::dropIfExists('deliveries');
    }
}
