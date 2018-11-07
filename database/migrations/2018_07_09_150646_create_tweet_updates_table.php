<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->timestamps();
        });

        Schema::create('tweet_updates', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('tweet_id')->nullable();
            $table->foreign('tweet_id')->references('id')->on('tweets')->onDelete('cascade');

            $table->unsignedInteger('update_type_id')->nullable();
            $table->foreign('update_type_id')->references('id')->on('update_types')->onDelete('cascade');

            $table->integer('value')->default(0);

            $table->timestamps();
        });

        Schema::create('user_house_updates', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_house_id')->nullable();
            $table->foreign('user_house_id')->references('id')->on('user_houses')->onDelete('cascade');

            $table->unsignedInteger('tweet_update_id')->nullable();
            $table->foreign('tweet_update_id')->references('id')->on('tweet_updates')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_house_updates');
        Schema::dropIfExists('tweet_updates');
        Schema::dropIfExists('update_types');
    }
}
