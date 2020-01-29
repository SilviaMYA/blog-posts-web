<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BlogsPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //blogs_posts table with an user_email Foreig Key field with onDelete  cascade
        Schema::create('blogs_post', function (Blueprint $table) {
            $table->increments('post_id');
            $table->string('user_email');
            $table->foreign('user_email')
                ->references('email')
                ->on('users')
                ->onDelete('cascade');
            $table->string('title');
            $table->string('content');
            $table->date('created');
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
