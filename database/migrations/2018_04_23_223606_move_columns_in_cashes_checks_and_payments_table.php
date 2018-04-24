<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveColumnsInCashesChecksAndPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cashes', function (Blueprint $table) {
            $table->integer('user_id')->after('id')->change();
            $table->integer('order_id')->before('date_paid')->change();
        });

        Schema::table('checks', function (Blueprint $table) {
            $table->integer('user_id')->after('id')->change();
            $table->integer('order_id')->before('account_number')->change();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->decimal('amount_paid', 18, 2)->after('id')->change();
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
