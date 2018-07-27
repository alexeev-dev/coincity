<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserHouseUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_house_updates', function($table) {
            $table->unsignedInteger('user_house_id')->after('id')->nullable();
            $table->foreign('user_house_id')->references('id')->on('user_houses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_house_updates', function($table) {
            $table->dropForeign('user_house_updates_user_house_id_foreign');
            $table->dropColumn('user_house_id');
        });
    }
}
