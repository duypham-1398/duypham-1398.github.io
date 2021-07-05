<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CTbantheolo extends Model
{
    //
    protected $table = "ctbantheolo";

    protected $fillable = ['id','ctdonban_id','lohang_id','ctbantheolo_so_luong','ctbantheolo_thanh_tien','ctbantheolo_ma'];

	public $timestamps = true;
}
