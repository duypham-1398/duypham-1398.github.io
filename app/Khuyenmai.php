<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Khuyenmai extends Model
{
    protected $table = "khuyenmai";

    protected $fillable = ['id','khuyenmai_tieu_de','khuyenmai_url','khuyenmai_noi_dung','khuyenmai_anh','khuyenmai_phan_tram','khuyenmai_thoi_gian','khuyenmai_tinh_trang'];

	public $timestamps = true;
}
