<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donban extends Model
{
    //
    protected $table = "donban";

    protected $fillable = ['id','donban_nguoi_nhan','donban_nguoi_nhan_email','donban_nguoi_nhan_sdt','donban_nguoi_nhan_dia_chi','donban_ghi_chu','donban_tong_tien','donban_thanh_toan','user_id','khachhang_id','tinhtranghd_id','donban_xu_ly','donban_ngay_ban','updated_at'];

	public $timestamps = true;
}
