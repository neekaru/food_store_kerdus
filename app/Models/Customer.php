<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $fillable = [
        'image',
        'name',
        'email',
        'password',
    ];


    /*
    |--------------------------------------------------------------------------
    | Hidden Attributes
    |--------------------------------------------------------------------------
    |
    | The attributes that should be hidden for serialization.
    |
    */
    protected $hidden = [
        'password',
    ];
}
