<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            $table->string('about_heading_one');
            $table->string('about_heading_two');
            $table->text('about_content');
            $table->string('about_image');
            $table->string('mission_heading');
            $table->text('mission_content');
            $table->string('mission_image');
            $table->string('vision_heading');
            $table->text('vision_content');
            $table->string('vision_image');
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
        Schema::dropIfExists('about_pages');
    }
}
