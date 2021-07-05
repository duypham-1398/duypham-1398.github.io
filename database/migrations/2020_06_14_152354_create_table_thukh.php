<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableThukh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thukh', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('khachhang_id');
            $table->decimal('tien_thu',10,2);
            $table->string('ly_do_thu');
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
        Schema::dropIfExists('thukh');
    }
}
