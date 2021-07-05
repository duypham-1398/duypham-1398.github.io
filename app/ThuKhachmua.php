<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThuKhachmua extends Model
{
    //
    protected $table = "thukm";

    protected $fillable = ['id','user_id','khachmua_id','tien_thu','ly_do_thu'];

	public $timestamps = true;
}
