<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = [
        //"name", "pic", "address", "phoneNo", "active", "category", "created_at", "updated_at"
        "company_id","company_name","username","password","secondary_password","code","category_id","registration_no",
        "office_no","hp_no","address","image","status","created_at","updated_at"
    ];
    
    protected $table = "homes_companies";
}
