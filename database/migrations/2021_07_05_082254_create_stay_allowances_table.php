<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStayAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stay_allowances', function (Blueprint $table) {
            $table->id();
            $table->date("from_date");
            $table->date("to_date")->nullable();
            $table->unsignedBiginteger('location');
            $table->unsignedBiginteger('allowance_id');
            $table->timestamps();
            $table->foreign('location')
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
        Schema::dropIfExists('stay_allowances');
    }
}
