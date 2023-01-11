<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFootersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
            // $table->string('bg_color');
            // $table->string('heading_color');
            // $table->string('text_color');
            $table->string('bg_image');
            $table->string('main_logo');
            $table->string('logo_1');
            $table->string('logo_2');
            $table->string('logo_3');
            $table->string('logo_4');
            $table->text('contact_numbers');
            $table->string('email');
            $table->string('address');
            $table->string('fb_link');
            $table->string('insta_link');
            $table->string('tw_link');
            $table->string('li_link');
            $table->text('copyright_text');
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
        Schema::dropIfExists('footers');
    }
}
