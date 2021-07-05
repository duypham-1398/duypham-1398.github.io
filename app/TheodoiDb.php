<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheodoiDb extends Model
{
    //
    protected $table = "theodoidb";

    protected $fillable = ['id','donban_id','lan_thanh_toan','so_tien_thanh_toan','so_tien_con_lai'];

	public $timestamps = true;
}
