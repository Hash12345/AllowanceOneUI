<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string("employee_id");
            $table->string("first_name");
            $table->string("middle_name");
            $table->string("last_name");
            $table->unsignedBiginteger('department_id');
            $table->string("job_title");
            $table->float("salary",7,2);
            $table->timestamps();
            $table->foreign('department_id')
                  ->references('id')
                  ->on('departments')
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
        Schema::dropIfExists('employees');
    }
}
