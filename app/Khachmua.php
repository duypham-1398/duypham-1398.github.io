<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Khachmua extends Model
{
    //
    protected $table = "khachmua";

    protected $fillable = ['id','khachmua_ten','khachmua_dia_chi','khachmua_sdt','khachmua_email','khachmua_tonno_dk','khachmua_tonco_dk','khachmua_phat_sinh_no','khachmua_phat_sinh_co','khachmua_tonno_ck','khachmua_tonco_ck'];

	public $timestamps = false;
}
