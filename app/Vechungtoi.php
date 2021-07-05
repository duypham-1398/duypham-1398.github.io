<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vechungtoi extends Model
{
    //
    protected $table="vechungtoi";

    protected $fillable = ['vechungtoi_anh','vechungtoi_noi_dung','vechungtoi_url','vechungtoi_tieu_de'];

	public $timestamps = true;
}
