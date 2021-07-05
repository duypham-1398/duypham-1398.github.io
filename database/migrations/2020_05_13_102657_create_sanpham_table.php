<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanpham', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('sanpham_ky_hieu');
            $table->string('sanpham_ten');
            $table->string('sanpham_url');
            $table->string('sanpham_anh');
            $table->longText('sanpham_mo_ta');
            $table->string('sanpham_gia_ban');
            $table->integer('sanpham_khuyenmai');
            $table->integer('loaisanpham_id')->unsigned();
            $table->foreign('loaisanpham_id')->references('id')->on('loaisanpham')->onUpdate('cascade');
            $table->integer('donvitinh_id')->unsigned();
            $table->foreign('donvitinh_id')->references('id')->on('donvitinh')->onUpdate('cascade');
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
        Schema::drop('sanpham');
    }
}
