<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Event extends Model implements JWTSubject
{
    //
    protected $table = "homes_exhibitions";
    
    protected $fillable = [
    //   "title", "venue", "startDt", "endDt", "imageID"
    "exhibition_id","title","location","date","end_date","image","status","created_at","updated_at"
        
    ];
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
