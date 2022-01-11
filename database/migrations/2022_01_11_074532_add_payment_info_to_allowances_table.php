<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentInfoToAllowancesTable extends Migration
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
            $table->boolean('payment_status')->default(0);
            $table->unsignedBigInteger('paid_by')->nullable();
            $table->date('payment_date')->nullable();
            $table->foreign('paid_by')
                  ->on('users')
                  ->references('id')
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
            $table->dropColumn('paid_by');
            $table->dropColumn('payment_date');
            $table->dropColumn('payment_status');
        });
    }
}
