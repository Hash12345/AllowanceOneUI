<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployeeColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string("employee_id");
            $table->string("first_name");
            $table->string("middle_name");
            $table->string("last_name");
            $table->unsignedBiginteger('department_id')->nullable();
            $table->string("job_title");
            $table->float("salary",7,2);
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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn("employee_id");
            $table->dropColumn("first_name");
            $table->dropColumn("middle_name");
            $table->dropColumn("last_name");
            $table->dropForeign('department_id');
            $table->dropColumn('department_id');
            $table->dropColumn("job_title");
            $table->dropColumn("salary",7,2);
        });
    }
}
