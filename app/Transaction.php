<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
      //"txnDt", "amount", "deposit", "salesPerson", "eid", "uid", "status", "cid"
      "order_id","order_number","user_id","company_id","event_id","sales_person",
      "amount","deposit_amount","redeem_points","remarks","status","attachment","created_at","updated_at"
    ];
    
    protected $table = "homes_orders";
}
