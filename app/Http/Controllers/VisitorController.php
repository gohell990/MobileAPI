<?php

namespace App\Http\Controllers;

use App\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //added
use Validator;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    //
    public function index(){
        $visitor = DB::table("visitor")
        ->join('users', 'users.id', '=', 'visitor.uid')
            ->join('event', 'event.id', '=', 'visitor.eid')
            ->select('users.id', 'users.name', 'users.email', 'event.title', 'event.venue', 'visitor.created_at')
            ->get();
            
        return response()->json($visitor, 200);    
        
    }
}
