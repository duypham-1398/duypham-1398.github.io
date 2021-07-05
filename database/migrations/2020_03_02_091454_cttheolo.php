<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cttheolo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cttheolo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cttheolo_ma');
            $table->integer('lohang_id')->unsigned();
            $table->foreign('lohang_id')->references('id')->on('lohang')->onUpdate('cascade');
            $table->integer('cttheolo_so_luong');
            $table->decimal('cttheolo_thanh_tien',10,2);
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
        Schema::dropIfExists('cttheolo');
    }
}
