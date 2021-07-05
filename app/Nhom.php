<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nhom extends Model
{
    protected $table="nhom";

    protected $fillable = ['nhom_ten','nhom_mo_ta','nhom_url'];

	public $timestamps = false;
}
