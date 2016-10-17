<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeStampForVote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->date('dateVote');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->dropColumn('dateVote');
        });
    }
}
