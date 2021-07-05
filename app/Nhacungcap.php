<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nhacungcap extends Model
{
    protected $table = "nhacungcap";

    protected $fillable = ['nhacungcap_ten','nhacungcap_dia_chi','nhacungcap_sdt'];

	public $timestamps = false;
}
