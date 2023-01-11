<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDigitalMarketingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('digital_marketings', function (Blueprint $table) {
            $table->id();
            $table->string('main_heading')->nullable();
            $table->text('main_description')->nullable();
            $table->string('main_image')->nullable();
            $table->text('service_description_heading')->nullable();
            $table->text('service_description')->nullable();
            $table->string('service_image')->nullable();
            $table->text('portfolio_heading')->nullable();
            $table->text('portfolio_text')->nullable();
            $table->text('custom_service_heading')->nullable();
            $table->text('custom_service_text')->nullable();
            $table->text('social_media_services_heading')->nullable();
            
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
        Schema::dropIfExists('digital_marketings');
    }
}
