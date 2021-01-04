<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
    protected $fillable = [
        'email', 'password'
    ];

    protected $table = 'users';
}
