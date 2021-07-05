<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CTtheolo extends Model
{
    //
    protected $table = "cttheolo";

    protected $fillable = ['id','cttheolo_ma','lohang_id','cttheolo_so_luong','cttheolo_thanh_tien','ctdonhang_id'];

	public $timestamps = true;
}
