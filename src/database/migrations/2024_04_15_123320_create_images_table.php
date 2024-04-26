<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->integer('no');
            $table->string('type', 255);
            $table->string('name', 255)->nullable();
            $table->string('path', 255)->nullable();
            $table->string('keywords', 255)->nullable();
            $table->boolean('cloudsync')->default(false);
            $table->timestamp('cloudsync_data')->nullable();
            $table->integer('controller_no')->nullable();
            $table->json('message1')->nullable();
            $table->json('message2')->nullable();
            $table->json('message3')->nullable();
            $table->json('three_line_alignment')->nullable();
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
        Schema::dropIfExists('images');
    }
}
