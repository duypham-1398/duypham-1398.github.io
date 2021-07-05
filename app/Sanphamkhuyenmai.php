<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sanphamkhuyenmai extends Model
{
    protected $table = 'sanphamkhuyenmai';

	protected $fillable = ['sanpham_id','khuyenmai_id'];

	public $timestamps = false;
}
