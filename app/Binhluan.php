<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Binhluan extends Model
{
    protected $table = "binhluan";

    protected $fillable = ['id','binhluan_ten','binhluan_email','binhluan_noi_dung','binhluan_trang_thai','sanpham_id'];

	public $timestamps = true;
}
