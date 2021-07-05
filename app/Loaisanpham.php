<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loaisanpham extends Model
{
    protected $table = 'loaisanpham';

	protected $fillable = ['loaisanpham_ten','nhom_id','loaisanpham_mo_ta','loaisanpham_url','loaisanpham_anh'];

	public $timestamps = false;
}
