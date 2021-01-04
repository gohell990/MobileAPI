<?php

namespace App\Http\Controllers;

use App\Redemption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //added
use Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RedemptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    
    
    public function index(Request $request)
    {
        //
        $limit = null;

        if($request->limit != null || $request->limit != ""){
            $limit = $request->limit;
        }

        $resp = DB::table("homes_redemptions as r")
        ->select("r.redemption_id", "r.code", "r.points", "r.redeemed_points", "u.name as UserName", "rm.name as ManagerName", "r.order_id")
        ->leftJoin("homes_users as u", "r.user_id", "=", "u.user_id")
        ->leftJoin("homes_redemption_manager as rm", function($join){
            $join->on("rm.manager_id", "=", "r.manager_id");
            $join->on("r.manager_id", ">", DB::raw("0"));
        });
        //->leftJoin("homes_orders as o", "o.order_id", "=", "r.order_id")
        if($request->redemption_id != null && $request->redemption_id != "" && $request->redemption_id){
            $resp->where("r.redemption_id", $request->redemption_id);
        }
        
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        if($request->zero_redemption != null && $request->zero_redemption != "" && $request->zero_redemption == true){
            $resp = DB::table("homes_orders as o")
            ->select("u.name as CustomerName", "u.email as Email", "u.hp_no as ContactNo", DB::raw("SUM(o.deposit_amount) as TotalPoints"))
            //, "o.created_at")
            ->leftJoin("homes_users as u", "o.user_id", "=", "u.user_id")
            ->leftJoin("homes_redemptions as r", function($join){
=======
        if($request->zero_redemption != null && $request->zero_redemption == true && $request->zero_redemption){
            $resp->join("homes_orders as o", function($join){
>>>>>>> parent of 3b2132f (Image storage:link)
=======
        if($request->zero_redemption != null && $request->zero_redemption == true && $request->zero_redemption){
            $resp->join("homes_orders as o", function($join){
>>>>>>> parent of 3b2132f (Image storage:link)
=======
        if($request->zero_redemption != null && $request->zero_redemption == true && $request->zero_redemption){
            $resp->join("homes_orders as o", function($join){
>>>>>>> parent of 3b2132f (Image storage:link)
                $join->ON("o.order_id", "=", "r.order_id");
                $join->ON("o.redeem_points", "=", "r.redeemed_points");
                $join->ON("o.redeem_points", "=", "r.redeemed_points");
                // ->where("r.points", "!=", "")
                // ->whereNotNull("r.points");
            })
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            // ->whereNull("r.order_id");
            ->whereNull("r.order_id");
            
            if($request->user_id != null && $request->user_id != ""){
                $resp->where("u.user_id", $request->user_id);
            }

            if($request->name != null && $request->name != ""){
                $resp->where("u.name", $request->name);
            }
            $resp->groupBy("u.name", "u.email", "u.hp_no");
            // $result = $resp->toSql();
            // return response()->json($result, 200);
=======
            ->whereIsNull("r.redemption_id");
>>>>>>> parent of 3b2132f (Image storage:link)
=======
            ->whereIsNull("r.redemption_id");
>>>>>>> parent of 3b2132f (Image storage:link)
        }
        if($request->day != null && $request->day != ""){
            // $resp->whereDate("e.date", "<=", $request->day);
            $resp->whereDay("r.created_at", "<=", $request->day." 00:00:00");
            $resp->whereDay("r.created_at", ">=", $request->day." 23:59:55");
        }
        if($request->month != null && $request->month != ""){
            $resp->whereMonth("r.created_at", $request->month);
            // $resp->whereMonth("r.created_at", ">=", $request->month);
        }
        if($request->year != null && $request->year != ""){
            $resp->whereYear("r.created_at", $request->year);
            // $resp->whereYear("e.end_date", ">=", $request->year);
        }
        if($request->date1 != null && $request->date1 != "" && $request->date2 != null && $request->date2 != ""){
            $resp->whereDate("r.created_at", ">=", $request->date1." 00:00:00")
            ->whereDate("r.created_at", "<=", $request->date2." 23:59:55");
        }
        // $resp->orderBy("r.redemption_id");
=======
            ->whereIsNull("r.redemption_id");
        }

        // $resp->whereNotNull("r.redemption_id")

        // $resp->whereNotNull("r.redemption_id")

        // $resp->whereNotNull("r.redemption_id")

        $resp->orderBy("r.redemption_id");
>>>>>>> parent of 3b2132f (Image storage:link)
        if($limit != null){
            $result = $resp->paginate($limit);

            return response()->json($result, 200);
        }
        // $resp->toSql();
        $result = $resp->get();
        //->get();
        return response()->json($result, 200);
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
        //
        $redeemed_points = null;
        if($request->redeemed_points != "" || $request->redeemed_points != null){
            $redeemed_points = $request->redeemed_points;
        }

        $rules = [
            "user_id" => "required|integer",
            "manager_id" => "required|integer",
            "order_id" => "required|integer",
            "redeemed_points" => "required|integer"
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(["Message"=>$validator->errors()], 400);
        }

        DB::table("homes_redemptions")->insert(
            [
                "code" => "RE".str_pad($request->user_id, 6, "0", STR_PAD_LEFT).str_pad($request->manager_id, 2, "0", STR_PAD_LEFT).
                str_pad($request->order_id, 7, "0", STR_PAD_LEFT),
                "user_id" => $request->input("user_id"),
                "manager_id" => $request->input("manager_id"),
                "redeemed_points" => $redeemed_points,
                "points" => $redeemed_points,
                "order_id" => $request->input("order_id"),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]    
        );
        
        return response()->json(["Points redeemed!"], 200);
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
        $redemption = DB::table("homes_redemptions")
        ->where("redemption_id", $id)
        ->get();

        if($redemption->isEmpty()){
            return response()->json(["Message"=>"Redemption not found"], 404);
        }
        return response()->json($redemption, 200);
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
        $redemption = DB::table("homes_redemptions")
        ->where("redemption_id", $id)
        ->get();
        

        if($redemption->isEmpty()){
            return response()->json(["message"=>"Redemption not found"], 404);
        }

        $rules = [
            "user_id" => "integer",
            "manager_id" => "integer",
            "order_id" => "integer",
            "points" => "integer",
            "redeemed_points" => "integer"
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(["Message"=>$validator->errors()], 400);
        }
        // $user = Auth::id();
        //$redemption->update($request->all());
        $redemption = DB::table("homes_redemptions")
        ->where("redemption_id", $id);
        
        if($request->user_id != null || $request->user_id != ""){
            $redemption->update(array("user_id"=>$request->user_id));
        }
        if($request->manager_id != null || $request->manager_id != ""){
            $redemption->update(array("manager_id"=>$request->manager_id));
        }
        if($request->order_id != null || $request->order_id != ""){
            $redemption->update(array("order_id"=>$request->order_id));
        }
        // if($request->points != null || $request->points != ""){
            
        // }
        if($request->redeemed_points != null || $request->redeemed_points != ""){
            $redemption->update(array("points"=>$request->points));
            $redemption->update(array("redeemed_points"=>$request->redeemed_points));
        }
        
        //$redemption->update(["updated_by", Auth::id()]);
        
        return response()->json(["Message"=>"UPDATED"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $redemption = DB::table("homes_redemptions")
        ->where("redemption_id", $id)
        ->get();

        if($redemption->isEmpty()){
            return response()->json(["message"=>"Redemption not found"], 404);
        }
        
        // DB::table("redemption")->where("id", $id)->update(["status"=>"x"]);
        $redemption = DB::table("homes_redemptions")
        ->where("redemption_id", $id)
        ->delete();

        return response()->json(["Message"=>"DELETED"], 200);
    }
}
