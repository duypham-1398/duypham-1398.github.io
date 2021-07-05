<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Khachhang extends Model
{
    protected $table = "khachhang";

    protected $fillable = ['khachhang_ten','khachhang_dia_chi','khachhang_sdt','khachhang_email','user_id','khachhang_tonno_dk','khachhang_tonco_dk','khachhang_phat_sinh_no','khachhang_phat_sinh_co','khachhang_tonno_ck','khachhang_tonco_ck'];

	public $timestamps = false;
}
