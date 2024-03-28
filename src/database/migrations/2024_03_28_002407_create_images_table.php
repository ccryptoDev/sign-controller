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
            $table->string("type")->default("bmp");
            $table->string("name")->nullable();
            $table->string("path")->nullable();
            $table->string("keywords")->nullable();
            $table->boolean("cloudsync")->default(false);
            $table->timestamp("cloudsync_data")->nullable();
            $table->integer("controller_no")->nullable();
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
