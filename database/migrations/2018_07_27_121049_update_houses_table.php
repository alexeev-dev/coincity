<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('houses', function($table) {
            $table->string('image')->after('name')->nullable();
            $table->string('image_small')->after('name')->nullable();
            $table->string('ico')->after('name')->nullable();
        });

        Schema::table('tweets', function($table) {
            $table->string('link')->after('id')->nullable();
            $table->string('alias')->after('id')->nullable();
            $table->string('description')->after('id')->nullable();
            $table->string('title')->after('id')->nullable();
            $table->string('image')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('houses', function($table) {
            $table->dropColumn('image');
            $table->dropColumn('image_small');
            $table->dropColumn('ico');
        });

        Schema::table('tweets', function($table) {
            $table->dropColumn('link');
            $table->dropColumn('alias');
            $table->dropColumn('description');
            $table->dropColumn('title');
            $table->dropColumn('image');
        });
    }
}
