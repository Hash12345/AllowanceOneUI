<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_categories', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("region");
            $table->integer("allowance1");
            $table->integer("allowance2");
            $table->integer("allowance3");
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
        Schema::dropIfExists('city_categories');
    }
}
