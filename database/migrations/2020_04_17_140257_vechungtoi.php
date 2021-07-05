<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vechungtoi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vechungtoi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vechungtoi_url');
            $table->longText('vechungtoi_noi_dung');
            $table->string('vechungtoi_anh');
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
        Schema::dropIfExists('vechungtoi');
    }
}
