<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();

            $table->string('title');
            $table->integer('prefecture');
            $table->string('location')->nullable();
            $table->datetime('meeting_at')->nullable();
            $table->datetime('start_at');
            $table->datetime('end_at')->nullable();
            $table->integer('capacity');
            $table->text('detail')->nullable();

            $table->string('load_type');
            $table->integer('distance');
            $table->string('route')->nullable();
            $table->string('map_url')->nullable();
            $table->string('level');
            $table->string('model')->nullable();
            $table->string('age');
            $table->timestamps();
            $table->softDeletes();
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
    }
}
