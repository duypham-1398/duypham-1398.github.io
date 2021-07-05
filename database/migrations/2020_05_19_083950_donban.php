<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Donban extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donban', function (Blueprint $table) {
            $table->increments('id');
            $table->string('donban_nguoi_nhan',100);
            $table->string('donban_nguoi_nhan_email');
            $table->string('donban_nguoi_nhan_sdt', 12);
            $table->string('donban_nguoi_nhan_dia_chi', 200);
            $table->longText('donban_ghi_chu')->nullable();
            $table->decimal('donban_tong_tien',10,2);
            $table->integer('khachmua_id')->unsigned();
            $table->foreign('khachmua_id')->references('id')->on('khachmuahang')->onUpdate('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->integer('tinhtranghd_id')->unsigned();
            $table->foreign('tinhtranghd_id')->references('id')->on('tinhtranghd')->onUpdate('cascade');
            $table->integer('donban_xu_ly');
            $table->date('donban_ngay_ban');
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
        Schema::dropIfExists('donban');
    }
}
