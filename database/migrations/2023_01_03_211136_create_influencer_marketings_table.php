<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfluencerMarketingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('influencer_marketings', function (Blueprint $table) {
            $table->id();
            $table->string('main_heading_1')->nullable();
            $table->string('main_heading_2')->nullable();
            $table->text('main_description')->nullable();
            $table->string('image')->nullable();
            $table->string('influencer_image')->nullable();
            $table->string('service_1_heading')->nullable();
            $table->text('service_1_text')->nullable();
            $table->string('service_2_heading')->nullable();
            $table->text('service_2_text')->nullable();
            $table->string('service_3_heading')->nullable();
            $table->text('service_3_text')->nullable();
            $table->string('service_4_heading')->nullable();
            $table->text('service_4_text')->nullable();
            $table->string('service_5_heading')->nullable();
            $table->text('service_5_text')->nullable();
            $table->string('service_6_heading')->nullable();
            $table->text('service_6_text')->nullable();
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
        Schema::dropIfExists('influencer_marketings');
    }
}
