<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->increments('id');

            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('alias')->nullable();
            $table->string('link')->nullable();
            $table->text('introtext')->nullable();
            $table->text('content')->nullable();
            $table->dateTime('pub_date')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->timestamps();
        });

        Schema::create('tweet_assignments', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('tweet_id')->nullable();
            $table->foreign('tweet_id')->references('id')->on('tweets')->onDelete('cascade');

            $table->unsignedInteger('house_id')->nullable();
            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');

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
        Schema::dropIfExists('tweet_assignments');
        Schema::dropIfExists('tweets');
    }
}
