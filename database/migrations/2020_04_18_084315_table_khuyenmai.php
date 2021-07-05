<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableKhuyenmai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khuyenmai', function (Blueprint $table) {
            $table->increments('id');
            $table->string('khuyenmai_tieu_de');
            $table->string('khuyenmai_url');
            $table->longText('khuyenmai_noi_dung');
            $table->string('khuyenmai_anh');
            $table->integer('khuyenmai_phan_tram');
            $table->integer('khuyenmai_thoi_gian');
            $table->integer('khuyenmai_tinh_trang');
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
        Schema::dropIfExists('khuyenmai');
    }
}
