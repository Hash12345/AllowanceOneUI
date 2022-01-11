<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('start_location');
            $table->unsignedBiginteger('target_location');
            $table->unsignedBiginteger('breakfast')->nullable();
            $table->unsignedBiginteger('lunch')->nullable();
            $table->unsignedBiginteger('dinner')->nullable();
            $table->tinyInteger("route")->default(1);
            $table->timestamps();
            $table->foreign('start_location')
                  ->references('id')
                  ->on('cities')
                  ->onDelete('cascade');
            $table->foreign('target_location')
                  ->references('id')
                  ->on('cities')
                  ->onDelete('cascade');
            $table->foreign('breakfast')
                  ->references('id')
                  ->on('cities')
                  ->onDelete('cascade');
            $table->foreign('lunch')
                  ->references('id')
                  ->on('cities')
                  ->onDelete('cascade');
            $table->foreign('dinner')
                  ->references('id')
                  ->on('cities')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
