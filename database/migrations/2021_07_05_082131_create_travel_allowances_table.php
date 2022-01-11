<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_allowances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('allowance_id');
            $table->unsignedBiginteger('start_place');
            $table->unsignedBiginteger('breakfast')->nullable();
            $table->unsignedBiginteger('lunch')->nullable();
            $table->unsignedBiginteger('dinner')->nullable();
            $table->date("start_date");
            $table->timestamps();
            $table->foreign('start_place')
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
            $table->foreign('allowance_id')
                  ->references('id')
                  ->on('allowances')
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
        Schema::dropIfExists('travel_allowances');
    }
}
