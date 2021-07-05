<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chitietdonban extends Model
{
    //
    protected $table = "chitietdonban";

    protected $fillable = ['sanpham_id','donban_id','chitietdonban_so_luong','chitietdonban_thanh_tien'];

	public $timestamps = false;
}
