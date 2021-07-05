<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheodoiDh extends Model
{
    //
    protected $table = "theodoidh";

    protected $fillable = ['id','donhang_id','lan_thanh_toan','so_tien_thanh_toan','so_tien_con_lai'];

	public $timestamps = true;
}
