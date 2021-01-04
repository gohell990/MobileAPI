<?php

namespace App\Http\Controllers;

use App\Event;
use App\Image;
use Illuminate\Support\Facades\Auth; //added
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $resp = DB::table("homes_exhibitions as e")
        ->select("exhibition_id", "e.title", "e.location", "e.date as StartDate", "e.end_date as EndDate", "e.image as EventImage")
        ->get();

        return response()->json($resp, 200);
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
            'title' => "required",
            "location" => "required",
            "status" => "required|integer",
            "date" => "required|date",  //date_format:Y-m-d
            "end_date" => "required|date"
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(["message"=>$validator->errors()], 404);
        }
        
        $image = new Image();
        $uid = Auth::user()->id;
        $thisDirectory = Carbon::now()->format("Y-m");
        $arrayPath = array();
        
<<<<<<< HEAD
=======
        
        // $image->image = $request->input('image');
        

<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> parent of 3b2132f (Image storage:link)
=======
>>>>>>> parent of 3b2132f (Image storage:link)
=======
>>>>>>> parent of 3b2132f (Image storage:link)
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); //get image extension
            $fileName = time() . "." . $extension;

            $path = $request->file('image')->store('/public/'.$thisDirectory);

            $arrayPath = explode("/", $path); 
            
            // $image->photo = $arrayPath[2];

            // $image->user_id = $uid;
            // $image->save();
            
            // $id = $image->id;

            // return response()->json($id, 200);
        }
        else {
            
            $image->image = "";
            
            return response()->json(["message"=>"Please upload a photo"], 404);
        }
        
        // return response()->json(["imageID"=>$id, "imageName:"=>$image->name], 200);
        
        // $event = Event::create([$request->title, $request->vanue, $request->]);
        $event = new Event([
            'title' => $request->get('title'),
            'location' => $request->get('location'),
            'image' => $arrayPath[2],
            'date' => $request->get('date'),
            //'startDt' => $request->get('startDt'),
            'end_date' => $request->get('end_date'),
            
        ]);
        
        $event->save();
        
        return response()->json(["message"=>"Event created!"], 200);
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
        /*$event = Event::find($id);
        
        if(is_null($event)){
            return response()->json(["message"=>"Event not found!"], 404);
        }
        
        return response()->json($event, 200);*/
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
        $event = DB::table("homes_exhibitions")
        ->where("exhibition_id", $id)
        ->get();
        
        if($event->isEmpty()){
            return response()->json(["Message"=>"Event not found"], 404);
        }
        
        $rules = [
            'title' => "min:4",
            'date' => "date_format:Y-m-d",
            'end_date' => "date_format:Y-m-d",
            'status' => "integer"
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(["Message"=>$validator->errors()], 404);
        }
        
        $event = DB::table("homes_exhibitions")
        ->where("exhibition_id", $id);
        if($request->title != null && $request->title != ""){
            $event->update(array('title'=>$request->title));
        }
        if($request->location != null && $request->location != ""){
            $event->update(array('location'=>$request->location));
        }   
        if($request->date != null && $request->date != ""){
            $event->update(array('date'=>$request->date));
        }
        if($request->end_date != null && $request->end_date != ""){
            $event->update(array('end_date'=>$request->end_date));
        }
        
        if($request->image != null && $request->image != ""){
            $image = new Image();
            $uid = Auth::user()->id;
            
            if($request->hasfile('image')){
                $thisDirectory = Carbon::now()->format("Y-m");

                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); //get image extension
                $fileName = time() . "." . $extension;

                $path = $request->file('image')->store('/public/'.$thisDirectory);

                // $file->move("uploads/image/", $fileName);
                // $image->photo = "e" . $uid . Carbon::now() . $fileName;

                $arrayPath = explode("/", $path); 

                $image->photo = $arrayPath[2];

                $image->user_id = $uid;
                $image->save();
                
                $event->update(array('image'=>$arrayPath[2]));
            }
        }
        
        if($request->status != null && $request->status != ""){
            $event->update(array('status'=>$request->status));
        }

        $event->update(array("updated_at"=>Carbon::now()));

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
        $event = DB::table("homes_exhibitions")
        ->where("exhibition_id", $id)
        ->get();
        
        if($event->isEmpty()){
            return response()->json(["message"=>"Event not found"], 404);
        }
        
        $event = DB::table("homes_exhibitions")
        ->where("exhibition_id", $id)
        ->update(['status'=>"2"]);
        // ->delete();
        
        return response()->json(null, 200);
    }
    
    /*public function getTotal(Request $request){
        $column = $request->column;
        $eid = $request->eid;
        // return response()->json(["column"=>$column], 200);
        
        if($column == "order"){
            $resp = DB::table("event")->leftJoin("transaction", "transaction.eid", "=", "event.id")->select("transaction.id")->where("transaction.eid", $eid)->count();
        }
        else{
            $resp = DB::table("event")->leftJoin("transaction", "transaction.eid", "=", "event.id")->select(DB::raw('SUM(transaction.'.$column.') as total'))->where("transaction.eid", $eid)->get();
        }
        
        return response()->json($resp, 200);
    }*/

    
    public function getEventDetails(Request $request){
        $resp = DB::table("homes_orders as o")
        ->select("e.exhibition_id", "e.title", "e.location", DB::raw("COUNT(o.order_id) as totalSales"), DB::raw('SUM(o.amount) as totalAmount'),
             DB::raw('SUM(o.deposit_amount) as totalDeposit'), "e.date", "e.end_date", "e.image")
             ->leftJoin("homes_exhibitions as e", "o.event_id", "=", "e.exhibition_id");

        $limit = null;

        if($request->limit != null && $request->limit != ""){
            $limit = $request->limit;
        }
        if($request->user_id != null && $request->user_id != ""){
            $resp->leftJoin("homes_users as u", "o.user_id", "=", "u.user_id")
            ->where("u.user_id", $request->user_id);
        }
        if($request->day != null && $request->day != ""){
            // $resp->whereDate("e.date", "<=", $request->day);
            $resp->whereDay("e.date", "<=", $request->day." 23:59:55");
            $resp->whereDay("e.end_date", ">=", $request->day." 00:00:00");
        }
        if($request->month != null && $request->month != ""){
            $resp->whereMonth("e.date", $request->month);
            $resp->whereMonth("e.end_date", $request->month);
            // $resp->whereMonth("r.created_at", ">=", $request->month);
        }
        if($request->year != null && $request->year != ""){
            $resp->whereYear("e.date", $request->year);
            $resp->whereYear("e.end_date", $request->year);
            // $resp->whereYear("r.created_at", ">=", $request->year);
        }
        if($request->date1 != null && $request->date1 != "" && $request->date2 != null && $request->date2 != ""){
            $resp->whereDate("e.date", ">=", $request->date1." 00:00:00")
            ->whereDate("e.end_date", "<=", $request->date2." 23:59:55");
        }
        if($request->exhibition_id != null && $request->exhibition_id != ""){

            $resp = DB::table("homes_orders as o")
            ->select("e.exhibition_id", "e.title", "e.location", DB::raw("COUNT(o.order_id) as totalSales"), DB::raw('SUM(o.amount) as totalAmount'),
                DB::raw('SUM(o.deposit_amount) as totalDeposit'), "e.date", "e.end_date", "c.company_name", "ca.name as category",
                DB::raw('SUM(CASE WHEN (r.redeemed_points > 0 AND r.redeemed_points < 3000) THEN 1 ELSE 0 END)  Tier1'),
                DB::raw('SUM(CASE WHEN (r.redeemed_points >= 3000 AND r.redeemed_points < 5000) THEN 1 ELSE 0 END) Tier2'), 
                DB::raw('SUM(CASE WHEN (r.redeemed_points >= 5000 AND r.redeemed_points < 10000) THEN 1 ELSE 0 END) Tier3'),
                DB::raw('SUM(CASE WHEN (r.redeemed_points >= 10000 AND r.redeemed_points < 15000) THEN 1 ELSE 0 END) Tier4'), 
                DB::raw('SUM(CASE WHEN (r.redeemed_points >= 15000 AND r.redeemed_points < 35000) THEN 1 ELSE 0 END) Tier5'), 
                DB::raw('SUM(CASE WHEN r.redeemed_points >= 35000 THEN 1 ELSE 0 END) Tier6')
            )
            ->leftJoin("homes_exhibitions as e", "o.event_id", "=", "e.exhibition_id")
            ->leftJoin("homes_companies as c", "o.company_id", "=", "c.company_id")
            ->leftJoin("category as ca", "c.category_id", "=", "ca.value")
            ->leftJoin("homes_redemptions as r", function($join){
                $join->ON("o.order_id", "=", "r.order_id");
                $join->ON("o.redeem_points", "=", "r.redeemed_points");
                $join->ON("o.redeem_points", "=", "r.redeemed_points")
                ->where("r.points", "!=", "")
                ->whereNotNull("r.points");
            })
            ->where("e.exhibition_id", $request->exhibition_id);

            if($request->category_id != null && $request->category_id != ""){
                $resp->where("c.created_at", $request->category_id);
            }
            if($request->day != null && $request->day != ""){
                // $resp->whereDate("e.date", "<=", $request->day);
                $resp->whereDay("e.date", "<=", $request->day." 23:59:55");
                $resp->whereDay("e.end_date", ">=", $request->day." 00:00:00");
            }
            if($request->month != null && $request->month != ""){
                $resp->whereMonth("e.date", $request->month);
                $resp->whereMonth("e.end_date", $request->month);
                // $resp->whereMonth("r.created_at", ">=", $request->month);
            }
            if($request->year != null && $request->year != ""){
                $resp->whereYear("e.date", $request->year);
                $resp->whereYear("e.end_date", $request->year);
                // $resp->whereYear("r.created_at", ">=", $request->year);
            }
            if($request->date1 != null && $request->date1 != "" && $request->date2 != null && $request->date2 != ""){
                $resp->whereDate("e.date", ">=", $request->date1." 00:00:00")
                ->whereDate("e.end_date", "<=", $request->date2." 23:59:55");
            }

            $resp->groupBy("e.exhibition_id", "e.location", "e.date", "e.end_date", "c.company_name", "ca.name", "e.title", "e.image");
        } else{
            
            $resp->groupBy("e.exhibition_id", "e.location", "e.date", "e.end_date", "e.title", "e.image");
        }
        
        $resp->orderBy("e.exhibition_id");

        if($limit != null){
            $result = $resp->paginate($limit);

            return response()->json($result, 200);
        }
        
        $result = $resp->get();
        //->get();
        return response()->json($result, 200);
    }
    
    /*public function search(Request $request){
        
        if($request->event_id == null || $request->event_id == ""){

        }

        $resp = DB::table("homes_exhibitions as e")->select("users.*")
        ->leftJoin("homes_orders as o", "transaction.eid", "=", "event.id")->leftJoin("users", "users.id", "=", "transaction.uid")
        ->get();
        
        if(empty($resp) || $resp == ""){
            return response()->json(["Message"=>"User not found"], 404);
        }
        
        return response()->json($resp, 200);
    }*/
}
