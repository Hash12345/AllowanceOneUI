<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersColumnToAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('allowances', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->date('approved_date');
            $table->integer('status')->default(0);
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('approved_by')
                  ->references('id')
                  ->on('users')
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
        Schema::table('allowances', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
            $table->dropColumn('status');
            $table->dropColumn('approved_by');
            $table->dropColumn('approved_date');
        });
    }
}
