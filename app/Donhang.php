<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donhang extends Model
{
    protected $table = "donhang";

    protected $fillable = ['id','donhang_nguoi_nhan','donhang_nguoi_nhan_email','donhang_nguoi_nhan_sdt','donhang_nguoi_nhan_dia_chi','donhang_ghi_chu','donhang_tong_tien','khachhang_id','tinhtranghd_id','donhang_xu_ly','donhang_ngay_ban'];

	public $timestamps = true;
}
