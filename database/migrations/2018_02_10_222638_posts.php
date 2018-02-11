<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('author')->default('Anonymous');
            $table->text('content');
            $table->timestamp('created')->useCurrent();
        });
        Schema::create('threads', function (Blueprint $table){
            $table->increments('id');
            $table->text('author')->default('Anonymous');
            $table->text('subject');
            $table->timestamp('created')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('threads');
    }
}
