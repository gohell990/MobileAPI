<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\Auth; //added
use Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Image;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = null;

        if($request->limit != null || $request->limit != ""){
            $limit = $request->limit;
        }

        $resp = DB::table("homes_orders as o")
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        ->select("u.name as UserName", "o.*", "c.company_name as CompanyName", "u.email as UserEmail", "u.hp_no as CustomerHP", "e.title as EventTitle", 
        DB::raw('CASE WHEN r.redeemed_points > 0 THEN r.redeemed_points ELSE "-" END as RedeemedStatus'), "ca.name as Category")
=======
        ->select("u.name as UserName", "o.*", "c.company_name as CompanyName", "e.title", "r.redemption_id as RedemptionID", "r.redeemed_points")
>>>>>>> parent of 3b2132f (Image storage:link)
=======
        ->select("u.name as UserName", "o.*", "c.company_name as CompanyName", "e.title", "r.redemption_id as RedemptionID", "r.redeemed_points")
>>>>>>> parent of 3b2132f (Image storage:link)
=======
        ->select("u.name as UserName", "o.*", "c.company_name as CompanyName", "e.title", "r.redemption_id as RedemptionID", "r.redeemed_points")
>>>>>>> parent of 3b2132f (Image storage:link)
        ->leftJoin("homes_users as u", "o.user_id", "=", "u.user_id")
        //->leftJoin("homes_users as us", "o.sales_person", "=", "us.user_id")
        ->join("homes_companies as c", "o.company_id", "=", "c.company_id")
        ->leftJoin("homes_exhibitions as e", function($join){
            $join->on("e.exhibition_id", "=", "o.event_id");
            $join->on("o.event_id", ">", DB::raw("0"));
        })
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        ->leftJoin("homes_redemptions as r", function($join){
            $join->ON("r.order_id", "=", "o.order_id");
            $join->ON("r.redeemed_points", "=", "o.redeem_points")
            ->where("r.manager_id", "!=", "0");
            // $join->ON("r.manager_id", "!=", "0");
            // ->where("r.points", "=", "");
        })
        ->leftJoin("category as ca", "ca.value", "=", "c.category_id");
=======
        ->leftJoin("homes_redemptions as r", "r.order_id", "=", "o.order_id");
>>>>>>> parent of 3b2132f (Image storage:link)
=======
        ->leftJoin("homes_redemptions as r", "r.order_id", "=", "o.order_id");
>>>>>>> parent of 3b2132f (Image storage:link)
=======
        ->leftJoin("homes_redemptions as r", "r.order_id", "=", "o.order_id");
>>>>>>> parent of 3b2132f (Image storage:link)
        // ->take($limit)
        // ->offset($offset)
        if($request->order_id != null && $request->order_id != ""){
            $resp->where("o.order_id", $request->order_id);
        }
        if($request->user_id != null && $request->user_id != ""){
            $resp->where("u.user_id", $request->user_id);
        }
        if($request->day != null && $request->day != ""){
            // $resp->whereDate("e.date", "<=", $request->day);
            $resp->whereDay("o.created_at", "<=", $request->day." 23:59:55");
            $resp->whereDay("o.created_at", ">=", $request->day." 00:00:00");
        }
        if($request->month != null && $request->month != ""){
            $resp->whereMonth("o.created_at", "<=", $request->month);
            // $resp->whereMonth("e.end_date", ">=", $request->month);
        }
        if($request->year != null && $request->year != ""){
            $resp->whereYear("o.created_at", "<=", $request->year);
            // $resp->whereYear("e.end_date", ">=", $request->year);
        }
        if($request->date1 != null && $request->date1 != "" && $request->date2 != null && $request->date2 != ""){
            $resp->whereDate("o.created_at", ">=", $request->date1." 00:00:00")
            ->whereDate("o.created_at", "<=", $request->date2." 23:59:55");
        }

        if($limit != null){
            $resp->distinct();
            $result = $resp->paginate($limit);

            return response()->json($result, 200);
        }
        
        $result = $resp->get();
        // $result = $resp->toSql();
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
        $rules = [
            //"txnDt" => "required|date",
            "amount" => "required|integer",
            "deposit_amount" => "required|integer",
            "exhibition_id" => "required|integer",
            "company_id" => "required|integer",
            "sales_person" => "required|integer",
            "user_id" => "required|integer",
            "remarks" => "required",
            
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(["message"=>$validator->errors()], 400);
        }
        
        $image = new Image();
        $thisDirectory = Carbon::now()->format("Y-m");
        $arrayPath = array();
        $attachment = "";

        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); //get image extension
            $fileName = time() . "." . $extension;

            $path = $request->file('image')->store('/public/'.$thisDirectory);

            $arrayPath = explode("/", $path); 
            $attachment = $arrayPath[2];

            // $image->photo = $arrayPath[2];

            // $image->user_id = $uid;
            // $image->save();
            
            // $id = $image->id;

            // return response()->json($id, 200);
        }
        else {
            
            $image->image = "";
            
            return response()->json(["message"=>"Please upload a reeipt"], 404);
        }
        if($request->hasfile('image2')){
            $file = $request->file('image2');
            $extension = $file->getClientOriginalExtension(); //get image extension
            $fileName = time() . "." . $extension;

            $path = $request->file('image')->store('/public/'.$thisDirectory);

            $arrayPath = explode("/", $path); 
            $attachment .= ", " . $arrayPath[2];
        }
        if($request->hasfile('image3')){
            $file = $request->file('image3');
            $extension = $file->getClientOriginalExtension(); //get image extension
            $fileName = time() . "." . $extension;

            $path = $request->file('image')->store('/public/'.$thisDirectory);

            $arrayPath = explode("/", $path); 
            $attachment .= ", " . $arrayPath[2];
        }
        $txn = Transaction::create($request->all() + ['status' => '1'] + ['order_number' => "TO".str_pad($request->exhibition_id, 4, "0", STR_PAD_LEFT) . 
        str_pad($request->company_id, 5, "0", STR_PAD_LEFT) . str_pad($request->user_id, 6, "0", STR_PAD_LEFT)] + ["attachment" => $attachment]);
        
        return response()->json(["message"=>"Order created"], 200);
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
        /*$txn = Transaction::find($id);
        
        if(is_null($txn)){
            return response()->json(["message"=>"Txn not found"], 404);
        }
        
        return response()->json($txn, 200);*/
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
        $txn = DB::table("homes_orders")
        ->where("order_id", $id)
        ->get();
        
        if($txn->isEmpty()){
            return response()->json(["Message"=>"Txn Not Found"], 404);
        }
        
        $rules = [
            
            "user_id" => "integer",
            "company_id" => "integer",
            "event_id" => "integer",
            "amount" => "numeric",
            "deposit_amount" => "numeric",
            "status" => "integer",
            "redeem_points" => "integer",
            
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(["Message"=>$validator->errors()], 400);
        }

        $txn = DB::table("homes_orders")
        ->where("order_id", $id);

        if($request->order_number != null || $request->order_number != ""){
            $txn->update(array('order_number'=>$request->order_number));
        }
        if($request->user_id != null || $request->user_id != ""){
            $txn->update(array('user_id'=>$request->user_id));
        }
        if($request->company_id != null || $request->company_id != ""){
            $txn->update(array('company_id'=>$request->company_id));
        }   
        if($request->event_id != null || $request->event_id != ""){
            $txn->update(array('event_id'=>$request->event_id));
        }
        if($request->sales_person != null || $request->sales_person != ""){
            $txn->update(array('sales_person'=>$request->sales_person));
        }
        if($request->amount != null || $request->amount != ""){
            $txn->update(array('amount'=>$request->amount));
        }
        if($request->deposit_amount != null || $request->deposit_amount != ""){
            $txn->update(array('deposit_amount'=>$request->deposit_amount));
        }
        if($request->redeem_points != null || $request->redeem_points != ""){
            $txn->update(array('redeem_points'=>$request->redeem_points));
        }
        if($request->remarks != null || $request->remarks != ""){
            $txn->update(array('remarks'=>$request->remarks));
        }
        if($request->status != null || $request->status != ""){
            $txn->update(array('status'=>$request->status));
        }
        
        $txn->update(array("updated_at"=>Carbon::now()));

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
        $txn = DB::table("homes_orders")
        ->where("order_id", $id)
        ->get();
        
        if($txn->isEmpty()){
            return response()->json(["Message"=>"Txn Not Found"], 404);
        }
        
        // $txn->update(["status"=>"x"]);
        
        DB::table("homes_orders")->where("id", "=", $id)->update(["status"=>"0"]);

        return response()->json(["Message"=>"DELETED"], 200);
    }
    
    public function getAllTxn(Request $request){
        $limit = null;

        if($request->limit != null || $request->limit != ""){
            $limit = $request->limit;
        }

        $resp = DB::table("homes_orders as o")
        ->select("o.order_id", "u.name as UserName", "u.email as UserEmail", "c.company_name as CompanyName", "o.sales_person as SalesPerson", 
        "o.amount as Amount", "o.deposit_amount as Deposit", "o.created_at")
        ->leftJoin("homes_users as u", "u.user_id", "=", "o.user_id")
        //->leftJoin("homes_users as sp", "sp.user_id", "=", "o.user_id")
        ->leftJoin("homes_companies as c", "o.company_id", "=", "c.company_id");
        // ->leftJoin("homes_redemptions as r", "o.order_id", "=", "r.redemption_id");
        

        if($request->order_id != null && $request->order_id != ""){
            $resp->where("o.order_id", $request->order_id);
        }
        if($limit != null){
            $result = $resp->paginate($limit);

            return response()->json($result, 200);
        }

        $resp->orderBy("o.order_id");
        $result = $resp->get();
        //->get();
        return response()->json($result, 200);
    }
    
    
    
}
