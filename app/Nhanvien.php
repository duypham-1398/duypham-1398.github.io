<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nhanvien extends Model
{
    protected $table = "nhanvien";

    protected $fillable = ['nhanvien_ten','nhanvien_dia_chi','nhanvien_sdt','nhanvien_cmnd','nhanvien_ngay_vao_lam','user_id'];

	public $timestamps = true;
}
