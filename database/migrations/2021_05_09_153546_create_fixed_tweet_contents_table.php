<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFixedTweetContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixed_tweet_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('content1', 140)->nullable();
            $table->integer('content1_delete_flg')->default(1);
            $table->string('content2', 140)->nullable();
            $table->integer('content2_delete_flg')->default(1);
            $table->string('content3', 140)->nullable();
            $table->integer('content3_delete_flg')->default(1);
            $table->integer('fixed_tweet_flg')->default(1);
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
        Schema::dropIfExists('fixed_tweet_contents');
    }
}
