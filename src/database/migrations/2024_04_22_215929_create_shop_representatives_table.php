<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopRepresentativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('shop_representatives', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('shop_id');
        $table->string('representative_name', 255);
        $table->string('email')->unique();
        $table->string('password');
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
        Schema::dropIfExists('shop_representatives');
    }
}
