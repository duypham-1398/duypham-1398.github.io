<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    protected $table = "sanpham";

    protected $fillable = ['id','sanpham_ky_hieu','sanpham_ten','sanpham_gia_ban','sanpham_url','sanpham_anh','sanpham_mo_ta','loaisanpham_id','sanpham_khuyenmai','donvitinh_id'];

	public $timestamps = true;
}
