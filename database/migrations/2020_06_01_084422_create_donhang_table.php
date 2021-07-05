<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonhangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donhang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('donhang_nguoi_nhan',100);
            $table->string('donhang_nguoi_nhan_email');
            $table->string('donhang_nguoi_nhan_sdt', 12);
            $table->string('donhang_nguoi_nhan_dia_chi', 200);
            $table->longText('donhang_ghi_chu')->nullable();
            $table->decimal('donhang_tong_tien',10,2);
            $table->integer('khachhang_id')->unsigned();
            $table->foreign('khachhang_id')->references('id')->on('khachhang')->onUpdate('cascade');
            $table->integer('tinhtranghd_id')->unsigned();
            $table->foreign('tinhtranghd_id')->references('id')->on('tinhtranghd')->onUpdate('cascade');
            $table->integer('donhang_xu_ly');
            $table->date('donhang_ngay_ban');
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
        Schema::drop('donhang');
    }
}
