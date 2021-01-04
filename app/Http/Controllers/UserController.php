<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //added
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index(Request $request, $userType)
    {
        //
        $user = null;
        $limit = null;

        if($request->limit != null || $request->limit != ""){
            $limit = $request->limit;
        }

        if(is_null($userType) || $userType == null || $userType == ""){
            return response()->json(["Message"=>"Please enter userType"], 400);
        }
        
        if($userType == "admin"){
            $user = DB::table("homes_admins")
            ->select("id", "name as email", "username", "updated_at");
            
            if($request->id != null || $request->id != ""){
                $user->where("id", $request->id);
            }
            if($request->email != null || $request->email != ""){
                $user->where("name", $request->email);
            }
            if($request->username != null || $request->username != ""){
                $user->where("username", $request->username);
            }
            
        }
        else if($userType == "user"){
            $user = DB::table("homes_users")
            ->select("user_id", "customer_id", "name", "email", "hp_no", "gender", "race", "state", "city", "delivery_address", "points", "dob", "age", "created_at", "updated_at");
            
            if($request->user_id != null || $request->user_id != ""){
                $user->where("user_id", $request->user_id);
            }
            if($request->customer_id != null || $request->customer_id != ""){
                $user->where("customer_id", $request->customer_id);
            }
            if($request->name != null || $request->name != ""){
                $user->where("name", $request->name);
            }
            if($request->email != null || $request->email != ""){
                $user->where("email", $request->email);
            }
            if($request->hp_no != null || $request->hp_no != ""){
                $user->where("hp_no", $request->hp_no);
            }
            if($request->gender != null || $request->gender != ""){
                $user->where("gender", $request->gender);
            }
            if($request->race != null || $request->race != ""){
                $user->where("race", $request->race);
            }
            if($request->state != null || $request->state != ""){
                $user->where("state", $request->state);
            }
            if($request->city != null || $request->city != ""){
                $user->where("city", $request->city);
            }
            if($request->delivery_address != null || $request->delivery_address != ""){
                $user->where("delivery_address", $request->delivery_address);
            }
            if($request->points != null || $request->points != ""){
                $user->where("points", $request->points);
            }
            if($request->dob != null || $request->dob != ""){
                $user->where("dob", $request->dob);
            }
            if($request->age != null || $request->age != ""){
                $user->where("age", $request->age);
            }
            // if($request->created_at != null || $request->created_at != ""){
            //     $user->where("created_at", $request->created_at);
            // }
            // if($request->updated_at != null || $request->updated_at != ""){
            //     $user->where("updated_at", $request->updated_at);
            // }
        }
        else if ($userType == "redemptionManager"){
            $user = DB::table("homes_redemption_manager")
            ->select("manager_id", "name", "email", "updated_at");
            
            if($request->manager_id != null || $request->manager_id != ""){
                $user->where("manager_id", $request->manager_id);
            }
            if($request->name != null || $request->name != ""){
                $user->where("name", $request->name);
            }
            if($request->email != null || $request->email != ""){
                $user->where("email", $request->email);
            }
            // if($request->updated_at != null || $request->updated_at != ""){
            //     $user->where("updated_at", $request->updated_at);
            // }
        }

        if($limit != null){
            $result = $user->paginate($limit);

            return response()->json($result, 200);
        }
        
        $result = $user->get();
        //->get();
        return response()->json($result, 200);

        //return response()->json($user, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userType = $request->userType;

        if(is_null($userType) || $userType == null || $userType == ""){
            return response()->json(["Message"=>"Please enter userType"], 400);
        }

        if($userType == "admin"){
            $admin_rules = [
                'email' => "required|unique:homes_admins,name",
                "username" => "required|min:4",
                "password" => "required",      
            ];

            $validator = Validator::make($request->all(), $admin_rules);
            if($validator->fails()){
                return response()->json(["message"=>$validator->errors()], 400);
            }
            
            // $password = bcrypt($request->password);
            
            // $request->password = $password;
    
            $user = User::create([
                'name' => request('email'),
                'username' => request('username'),
                'password' => bcrypt(request('password')),
                
            ]);
        }
        else if($userType == "redemptionManager"){
            $rm_rules = [
                "name" => "required|min:4",
                "email" => "required|unique:homes_redemption_manager,email",
                "password" => "required"
            ];

            $validator = Validator::make($request->all(), $rm_rules);
            if($validator->fails()){
                return response()->json(["message"=>$validator->errors()], 400);
            }

            $password = bcrypt(request('password'));

            $rm = DB::insert('insert into homes_redemption_manager (name, email, password, created_at, updated_at) values (?, ?, ?, ?, ?)', 
            [$request->name, $request->email, $password, Carbon::now(), Carbon::now()]);
            
        }
        else{
            return response()->json(["Message"=>"Please enter valid userType"], 400);
        }

        return response()->json(["message"=>"Created!"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $user = User::find($id);
        // if(is_null($user)){
        //     return response()->json(["message"=>"Record not found!"], 404);
        // }

        // return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $user = User::find($id);
        $userType = $request->userType;

        if(is_null($userType) || $userType == null || $userType == ""){
            return response()->json(["Message"=>"Please enter userType"], 400);
        }

        if($userType == "admin"){

            $admin_rules = [
                'name' => "unique:homes_admins,name", 
            ];
            
            $admin = User::find($id);

            if(!$admin->first()){
                return response()->json(["message"=>"Admin not found!"], 404);
            }

            $validator = Validator::make($request->all(), $admin_rules);
            if($validator->fails()){
                return response()->json(["message"=>$validator->errors()], 400);
            }

            //$password = $admin->password;
            if($request->email != null || $request->email != ""){
                $admin->name = $request->email;
                
            }
            if($request->username != null || $request->username != ""){
                $admin->username = $request->username;
                
            }
            if($request->password != null || $request->password != ""){
                $password = bcrypt($request->password);
                $admin->password = $password;
                
            }

            $admin->save();

        }

        else if($userType == "user"){

            $user_rules = [
                "name" => "min:4",
                "gender" => "alpha",
                "race" => "alpha",
                "state" => "alpha",
                "city" => "alpha",
                "points" => "integer",
                "age" => "integer",
                "dob" => "date_format:Y-m-d"
            ];

            $user = DB::table("homes_users as u")
            ->where("u.user_id", $id)
            ->get();    

            if($user->isEmpty()){
                return response()->json(["message"=>"User not found!"], 404);
            }

            $validator = Validator::make($request->all(), $user_rules);
            if($validator->fails()){
                return response()->json(["message"=>$validator->errors()], 400);
            }

            $user = DB::table("homes_users")
            ->where("user_id", $id);

            if($request->password != null || $request->password != ""){
                $password=bcrypt($request->password);
                $user->update(array('password'=>$password));
            }
            if($request->name != null || $request->name != ""){
                
                $user->update(array('name'=>$request->name));
            }
            if($request->hp_no != null || $request->hp_no != ""){
                
                $user->update(array('hp_no'=>$request->hp_no));
            }
            if($request->gender != null || $request->gender != ""){
                
                $user->update(array('gender'=>$request->gender));
            }
            if($request->race != null || $request->race != ""){
                
                $user->update(array('race'=>$request->race));
            }
            if($request->state != null || $request->state != ""){
                
                $user->update(array('state'=>$request->state));
            }
            if($request->city != null || $request->city != ""){
                
                $user->update(array('city'=>$request->city));
            }
            if($request->points != null || $request->points != ""){
                
                $user->update(array('points'=>$request->points));
            }
            if($request->age != null || $request->age != ""){
                
                $user->update(array('age'=>$request->age));
            }
            if($request->dob != null || $request->dob != ""){
                
                $user->update(array('dob'=>$request->dob));
            }
            //$user->update($request->all());
        }
        else if($userType == "redemptionManager"){

            $rm_rules = [
                "name" => "min:4",
                "email" => "unique:homes_redemption_manager,email"
            ];

            $rm = DB::table("homes_redemption_manager")
            //->select("u.customer_id", "u.name", "u.email", "u.hp_no", "u.gender", "u.race", "u.state", "u.city", "u.delivery_address", "u.points", "u.dob", "u.age")
            ->where("manager_id", $id)
            ->get();    

            if($rm->isEmpty()){
                return response()->json(["message"=>"User not found!"], 404);
            }

            $validator = Validator::make($request->all(), $rm_rules);
            if($validator->fails()){
                return response()->json(["message"=>$validator->errors()], 400);
            }

            $rm = DB::table("homes_redemption_manager")
            ->where("manager_id", $id);

            if($request->password != null || $request->password != ""){
                $request->password=bcrypt(request('password'));
                
                $rm->update(array('password'=>$request->password));
            }
            if($request->name != null || $request->name != ""){
                
                $rm->update(array('name'=>$request->name));
            }
            if($request->email != null || $request->email != ""){
                
                $rm->update(array('email'=>$request->email));
            }

            //$rm->save();
        }

        return response()->json(["message"=>"UPDATED"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $userType = $request->userType;

        if(is_null($userType) || $userType == null || $userType == ""){
            return response()->json(["Message"=>"Please enter userType"], 400);
        }

        if($userType=="admin"){
            $admin = User::find($id);
            
            if($admin->isEmpty()){
                return response()->json(["message"=>"Admin not found!"], 404);
            }

            $admin->delete();
        }
        else if($userType=="user"){
            $user = DB::table("homes_users")
            ->where("user_id", $id)
            ->get();

            if($user->isEmpty()){
                return response()->json(["message"=>"User not found!"], 404);
            }

            $user = DB::table("homes_users")
            ->where("user_id", $id)
            ->update(["status"=>"2"]);
        }
        else if($userType=="redemptionManager"){
            $rm = DB::table("homes_redemption_manager")
            ->where("manager_id", $id)
            ->get();

            if($rm->isEmpty()){
                return response()->json(["message"=>"User not found!"], 404);
            }

            $rm = DB::table("homes_redemption_manager")
            ->where("manager_id", $id)
            ->delete();
            
        }
        else{
            return response()->json(["Message"=>"Invalid user type"], 400);
        }

        return response()->json(["message"=>"DELETED"], 200);
    }

    
    /*public function getUserByID(Request $request){
        $id = $request->id;
        $userType = $request->userType;

        if(is_null($userType) || $userType == null || $userType == ""){
            return response()->json(["Message"=>"Please enter userType"], 400);
        }
        if(is_null($id) || $id == null || $id == ""){
            return response()->json(["Message"=>"Please enter id"], 400);
        }

        if($userType == "user"){
            $user = DB::table('homes_users')
            ->select("user_id", "customer_id", "name", "email", "hp_no", "gender", "race", "state", "city", "delivery_address", "points", "dob", "age")
            ->where('user_id', '=', $id)
            ->get();
            
            if(is_null($user)){
                return response()->json(["Message"=>"User not exists"], 404);
            }

            return response()->json($user, 200);
        }
        else if($userType == "admin"){
            $admin = DB::table("homes_admins as a")
            ->select("a.id", "a.name as email", "a.username")
            ->where("a.id", $id)
            ->get();

            if(is_null($admin)){
                return response()->json(["Message"=>"Admin not exists"], 404);
            }

            return response()->json($admin, 200);
        }
        else if($userType=="redemptionManager"){
            $rm = DB::table("homes_redemption_manager as rm")
            ->select("rm.manager_id", "rm.name", "rm.email")
            ->where("rm.manager_id", $id)
            ->get();

            if(is_null($rm)){
                return response()->json(["Message"=>"Redemption Manager not exists"], 404);
            }

            return response()->json($rm, 200);
        }
        
    }*/
    
    public function searching(Request $request){

        
        $limit = null;

        if($request->limit != null || $request->limit != ""){
            $limit = $request->limit;
        }

        if($request->zero_order != null && $request->zero_order != "" && $request->zero_order == true){
            $resp = DB::table("homes_users as u")
            ->select("u.user_id", "u.customer_id", "u.name", "u.email", "u.hp_no", "u.gender", "u.race", "u.state", "u.city", "u.delivery_address",
            "u.points", "u.dob", "u.age", "u.created_at", "u.updated_at")
            ->leftJoin("homes_orders as o", "o.user_id", "=", "u.user_id")
            ->whereNull("o.order_id");

            
            if($request->day != null && $request->day != ""){
                // $resp->whereDate("e.date", "<=", $request->day);
                $resp->whereDay("o.created_at", ">=", $request->day." 00:00:00");
                $resp->whereDay("o.created_at", "<=", $request->day." 23:59:55");
            }
            if($request->month != null && $request->month != ""){
                $resp->whereMonth("o.created_at", $request->month);
                // $resp->whereMonth("e.end_date", ">=", $request->month);
            }
            if($request->year != null && $request->year != ""){
                $resp->whereYear("o.created_at", $request->year);
                // $resp->whereYear("o.created_at", ">=", $request->year);
            }
            if($request->date1 != null && $request->date1 != "" && $request->date2 != null && $request->date2 != ""){
                $resp->whereDate("o.created_at", ">=", $request->date1." 00:00:00")
                ->whereDate("o.created_at", "<=", $request->date2." 23:59:55");
            }
            if($limit != null){
                $result = $resp->paginate($limit);
    
                return response()->json($result, 200);
            }
            
            $result = $resp->get();

            return response()->json($result, 200);
            // return response()->json(["message"=>"anything"], 200);
        }

        $resp = DB::table('homes_orders as o')
        ->select("u.user_id", "u.name", "u.email", "u.customer_id", "u.race", "u.age", DB::raw("SUM(o.amount) as totalAmount"), DB::raw("SUM(o.deposit_amount) as totalDeposit"),
        DB::raw("COUNT(o.order_id) as totalPurchase"), DB::raw("SUM(r.redeemed_points) as TotalRedeemedPoints"))
        
        ->leftJoin("homes_users as u", "o.user_id", "=", "u.user_id")
        ->leftJoin("homes_redemptions as r", function($join){
            $join->ON("o.order_id", "=", "r.order_id")
            ->where("r.manager_id", "!=", "0");
            // $join->ON("r.manager_id", "!=", "0");
        });
        
        // ->toSql();

        // return response()->json($resp, 200);
        
        if($request->exhibition_id != null && $request->exhibition_id != ""){
            
            $resp->leftJoin("homes_exhibitions as e", "o.event_id", "=", "e.exhibition_id")
            ->where("e.exhibition_id", $request->exhibition_id);
        }
        if($request->user_id != null && $request->user_id != ""){

            $resp->where("u.user_id", $request->user_id); 
        }
        if($request->username != null && $request->username != ""){

            $resp->where("u.name", $request->username);
        }
        if($request->day != null && $request->day != ""){
            // $resp->whereDate("e.date", "<=", $request->day);
            $resp->whereDay("o.created_at", ">=", $request->day." 00:00:00");
            $resp->whereDay("o.created_at", "<=", $request->day." 23:59:55");
        }
        if($request->month != null && $request->month != ""){
            $resp->whereMonth("o.created_at", $request->month);
            // $resp->whereMonth("o.created_at", ">=", $request->month);
        }
        if($request->year != null && $request->year != ""){
            $resp->whereYear("o.created_at", $request->year);
            // $resp->whereYear("o.created_at", ">=", $request->year);
        }
        if($request->date1 != null && $request->date1 != "" && $request->date2 != null && $request->date2 != ""){
            $resp->whereDate("o.created_at", ">=", $request->date1." 00:00:00")
            ->whereDate("o.created_at", "<=", $request->date2." 23:59:55");
        }

        $resp->groupBy("u.user_id", "u.name", "u.email", "u.customer_id", "u.race", "u.age");
        // ->paginate(15)
        // ->toSql();
        if($limit != null){
            $result = $resp->paginate($limit);

            return response()->json($result, 200);
        }
        
        $result = $resp->get();
        // ->toSql();
        // return response()->json($resp, 200);

        return response()->json($result, 200);
    }
}
