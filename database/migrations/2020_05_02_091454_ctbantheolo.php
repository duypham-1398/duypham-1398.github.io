<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ctbantheolo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ctbantheolo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ctbantheolo_ma');
            $table->integer('lohang_id')->unsigned();
            $table->foreign('lohang_id')->references('id')->on('lohang')->onUpdate('cascade');
            $table->integer('ctbantheolo_so_luong');
            $table->decimal('ctbantheolo_thanh_tien',10,2);
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
        Schema::dropIfExists('ctbantheolo');
    }
}
