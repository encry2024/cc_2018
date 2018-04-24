<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cashes', function (Blueprint $table) {
            $table->integer('user_id')->after('id')->unsigned();
            $table->integer('order_id')->after('user_id')->unsigned();
            $table->dropColumn('payment_id');
            $table->dropColumn('amount_paid');
        });

        Schema::table('checks', function (Blueprint $table) {
            $table->integer('user_id')->after('id')->unsigned();
            $table->integer('order_id')->after('user_id')->unsigned();
            $table->dropColumn('payment_id');
            $table->dropColumn('amount_paid');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->decimal('amount_paid', 18, 2)->after('id');
            $table->dropColumn('user_id');
            $table->dropColumn('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
