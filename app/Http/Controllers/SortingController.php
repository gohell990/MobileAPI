<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class SortingController extends Controller
{
    //
    public function orderById(){

        $user = DB::table("users")->orderBy('id')->get();
        // $user = User::all();
        // return response()->json($user, 200);
        return response()->json(["message"=>"hello world"]);
    }
}
