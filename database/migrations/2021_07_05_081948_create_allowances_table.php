<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allowances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('employee_id');
            $table->unsignedBiginteger('start_location');
            $table->unsignedBiginteger('target_location');
            $table->date('start_date');
            $table->date('return_date')->nullable();
            $table->text("trip_reason");
            $table->float("trip_allowance", 7, 2);
            $table->float("transport_allowance", 7, 2)->nullable();
            $table->float("fuel_allowance", 7, 2)->nullable();
            $table->float("reserve", 7, 2)->nullable();
            $table->timestamps();
            $table->foreign('employee_id')
                  ->references('id')
                  ->on('employees')
                  ->onDelete('cascade');
            $table->foreign('start_location')
                  ->references('id')
                  ->on('cities')
                  ->onDelete('cascade');
            $table->foreign('target_location')
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
        Schema::dropIfExists('allowances');
    }
}
