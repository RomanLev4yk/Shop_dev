<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeVariableIdColumnInMultiLinesVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('multi_lines_variables', function (Blueprint $table) {
            $table->renameColumn('multi_column_variable_id', 'variable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('multi_lines_variables', function (Blueprint $table) {
            //
        });
    }
}
