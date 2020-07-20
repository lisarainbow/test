<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sender_id')->unsigned()->default(1);
            $table->bigInteger('receiver_id')->unsigned()->default(1);
            $table->string('message');
            $table->timestamps();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('sender_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('receiver_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_receiver_id_foreign');
            $table->dropForeign('posts_sender_id_foreign');
        });

        Schema::dropIfExists('posts');
    }
}
