<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Khachmua extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khachmua', function (Blueprint $table) {
            $table->increments('id');
            $table->string('khachmua_ten',100);
            $table->string('khachmua_email')->unique();
            $table->string('khachmua_sdt', 12);
            $table->string('khachmua_dia_chi', 200);
            $table->string('khachmua_tonno_dk');
            $table->string('khachmua_tonco_dk');
            $table->string('khachmua_phat_sinh_no');
            $table->string('khachmua_phat_sinh_co');
            $table->string('khachmua_tonno_ck');
            $table->string('khachmua_tonco_ck');
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
        Schema::dropIfExists('khachmua');
    }
}
