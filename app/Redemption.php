<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redemption extends Model
{
    //
    protected $fillable = [
        //"uid", "rmid", "TID", "redeemedPoints", "status"
        "redemption_id","code","user_id","manager_id","order_id","points","redeemed_points","created_at","updated_at"
    ];
    
    protected $table = "homes_redemptions";
}
