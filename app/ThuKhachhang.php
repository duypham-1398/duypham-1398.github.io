<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThuKhachhang extends Model
{
    //
    protected $table = "thukh";

    protected $fillable = ['id','user_id','khachhang_id','tien_thu','ly_do_thu'];

	public $timestamps = true;
}
