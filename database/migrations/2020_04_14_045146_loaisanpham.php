<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Loaisanpham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loaisanpham', function (Blueprint $table) {
            $table->increments('id');
            $table->string('loaisanpham_ten', 200);
            $table->string('loaisanpham_url',200);
            $table->longText('loaisanpham_mo_ta')->nullable();
            $table->string('loaisanpham_anh');
            $table->integer('nhom_id')->unsigned();
            $table->foreign('nhom_id')->references('id')->on('nhom')->onUpdate('cascade');
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
        Schema::dropIfExists('loaisanpham');
    }
}
