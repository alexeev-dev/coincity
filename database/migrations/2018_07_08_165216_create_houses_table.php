<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('icon')->nullable();
            $table->string('image_small')->nullable();
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->text('content')->nullable();

            $table->integer('max_money')->default(0);
            $table->integer('money_per_hour')->default(0);

            $table->timestamps();
        });

        Schema::create('user_houses', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('house_id')->nullable();
            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');

            $table->dateTime('money_collected')->nullable();
            $table->bigInteger('money')->default(0);

            $table->integer('position')->nullable();
            $table->boolean('fav')->default(0);

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
        Schema::dropIfExists('user_houses');
        Schema::dropIfExists('houses');
    }
}
