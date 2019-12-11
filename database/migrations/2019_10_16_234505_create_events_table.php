<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->unsignedBigInteger('community_id')->nullable();
            $table->string('prefecture')->nullable();
            $table->string('location')->nullable();
            $table->integer('capacity');
            $table->string('description')->nullable();
            $table->string('load_type')->nullable();
            $table->integer('distance')->nullable();
            $table->string('route')->nullable();
            $table->string('map_url', 5000)->nullable();
            $table->string('level')->nullable();
            $table->string('model')->nullable();
            $table->string('image_path')->nullable();
            $table->datetime('meeting_at')->nullable();
            $table->datetime('start_at');
            $table->datetime('end_at')->nullable();
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
        Schema::dropIfExists('events');
    }
}
