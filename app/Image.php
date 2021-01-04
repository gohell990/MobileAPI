<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table="homes_photos";

    protected $fillable = [
        //'name', "created_at"
        "photo", "user_id", "photo_id", "created_at"
    ];

    public $timestamps = ["created_at"]; //only want to used created_at column
    const UPDATED_AT = null; //and updated by default null set
}
