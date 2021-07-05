<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    //
    protected $table = "password_resets";

    protected $fillable = [
        'email',
        'token',
    ];
    public $timestamps = false;
}
