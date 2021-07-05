<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donvitinh extends Model
{
    protected $table = 'donvitinh';

	protected $fillable = ['donvitinh_ten','donvitinh_mo_ta','donvitinh_da_xoa'];

	public $timestamps = false;
}
