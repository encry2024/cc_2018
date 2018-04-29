<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsOnReceivablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receivables', function (Blueprint $table) {
            $table->dropColumn('payments_id');
            $table->decimal('amount')->after('id');
            $table->integer('receivable_id')->after('amount');
            $table->string('receivable_type')->after('receivable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receivables', function (Blueprint $table) {
            $table->integer('payments_id');
            $table->dropColumn('receivable_id');
            $table->dropColumn('receivable_type');
        });
    }
}
