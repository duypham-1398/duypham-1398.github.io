<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKhachhangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khachhang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('khachhang_ten',100);
            $table->string('khachhang_email')->unique();
            $table->string('khachhang_sdt', 12);
            $table->string('khachhang_dia_chi', 200);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->string('khachhang_tonno_dk');
            $table->string('khachhang_tonco_dk');
            $table->string('khachhang_phat_sinh_no');
            $table->string('khachhang_phat_sinh_co');
            $table->string('khachhang_tonno_ck');
            $table->string('khachhang_tonco_ck');
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
        Schema::drop('khachhang');
    }
}
