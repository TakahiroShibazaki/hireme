<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaligraphyClassListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caligraphy_class_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('area_code')->unsigned();
            $table->string('class_name');
            $table->string('address');
            $table->string('access')->default('-');
            $table->string('introduction')->default('-');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caligraphy_class_lists');
    }
}
