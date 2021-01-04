<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //added
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\UserController;
use Carbon\Carbon;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        
        return response()->json(Company::all(), 200);
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
            "company_name" => "required",
            "username" => "required|unique:homes_companies,username",
            "password" => "required",
            "secondary_password" => "required",
            "status" => "required|integer",
            "office_no" => "required",
            "hp_no" => "required",
            "category_id" => "required|integer",
            "code" => "required|integer"
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(["message"=>$validator->errors()], 400);
        }
        
        $company = Company::create($request->all() + ["registration_no" => Str::random(7)]);
        
        // $user = new UserController();
        // $user->store($request);

        return response()->json(["Company Created!"], 200);
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
        /*$company = Company::find($id);
        
        if(is_null($company)){
            return response()->json(["message"=>"Company not found!"], 404);
        }
        
        return response()->json(["message"=>$company], 200);*/
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
        $company = DB::table("homes_companies")
        ->where("company_id", $id)
        ->get();
        
        
        if($company->isEmpty()){
            return response()->json(["message"=>"Company not found!"], 404);
        }
        
        $rules = [
        //   "hp_no" => "integer",
        //   "office_no" => "integer",
          "status" => "integer",
          "category_id" => "integer"
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(["message"=>$validator->errors()], 400);
        }
        
        $company = DB::table("homes_companies")
        ->where("company_id", $id);

        if($request->company_name != null || $request->company_name != ""){
            $company->update(array('company_name'=>$request->company_name));
        }
        if($request->username != null || $request->username != ""){
            $company->update(array('username'=>$request->username));
        }
        if($request->password != null || $request->password != ""){
            $password = bcrypt($request->password);
            $company->update(array('password'=>$password));
        }
        if($request->secondary_password != null || $request->secondary_password != ""){
            $secondary_password = bcrypt($request->secondary_password);
            $company->update(array('secondary_password'=>$secondary_password));
        }
        if($request->code != null || $request->code != ""){
            $company->update(array('code'=>$request->code));
        }
        if($request->category_id != null || $request->category_id != ""){
            $company->update(array('category_id'=>$request->category_id));
        }
        if($request->registration_no != null || $request->registration_no != ""){
            $company->update(array('registration_no'=>$request->registration_no));
        }   
        if($request->office_no != null || $request->office_no != ""){
            $company->update(array('office_no'=>$request->office_no));
        }
        if($request->hp_no != null || $request->hp_no != ""){
            $company->update(array('hp_no'=>$request->hp_no));
        }
        if($request->address != null || $request->address != ""){
            $company->update(array('address'=>$request->address));
        }
        if($request->status != null || $request->status != ""){
            $company->update(array('status'=>$request->status));
        }
        
        $company->update(array('updated_at'=>Carbon::now()));
        
        return response()->json(["message"=>"UPDATED"], 200);
        
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
        //$company = Company::find($id);
        $company = DB::table("homes_companies")
        ->where("company_id", $id)
        // ->toSql();
        ->get();
        // return response()->json($company, 200);
        if($company->isEmpty()){
            return response()->json(["message"=>"Company not found!"], 404);
        }
        else{
            $company = DB::table("homes_companies")->where('company_id', $id)
            //->update(['active' => "0"]);
            ->update(['status' => "0"]);
        
            return response()->json(["Message"=>"DELETED"], 200);
        }
    }
    
    /*public function getAll(){
        
        
        // $resp = DB::table("company")->select("company.id", "company.name", DB::raw("SUM(transaction.amount) as totalAmount"), DB::raw("SUM(transaction.deposit) as totalDeposit"))
        // ->leftJoin("users", "users.cid", "=", "company.id") //     $join->on("users.cid", "=", "company.id")
        // ->leftJoin("transaction", "transaction.uid", "=", "users.id")
        // ->groupBy("company.id", "company.name")
        // ->get();

        $resp = DB::table("homes_companies as c")->select("c.company_id", "c.company_name", DB::raw("SUM(o.amount) as totalAmount"),
        DB::raw("SUM(o.deposit_amount) as totalDeposit"))
        ->leftJoin("homes_orders as o", "c.company_id", "=", "o.company_id")
		->groupBy("c.company_id", "c.company_name")
        ->get();

        return response()->json($resp, 200);
    }*/
    
    public function companySales(Request $request){
		
		if($request == null){
			return response()->json(["Message"=>"Please provide search value"], 400);
		}
        
        $limit = null;

        
        $resp = DB::table("homes_companies as c")
        ->select("c.company_id", "c.company_name", "c.office_no", "ca.name", DB::raw("COUNT(o.order_id) as totalSales"), 
        DB::raw("SUM(o.amount) as totalAmount"), DB::raw("SUM(o.deposit_amount) as totalDeposit"))
        
        ->leftJoin("homes_orders as o", "o.company_id", "=", "c.company_id")
		->leftJoin("homes_exhibitions as e", "e.exhibition_id", "=", "o.event_id") //add
		->leftJoin("category as ca", "ca.value", "=", "c.category_id");
       
        if(isset($request->company_id) && $request->company_id != null && $request->company_id != ''){
            $resp->where("c.company_id", "=", $request->company_id);
            
        }
        if(isset($request->company_name) && $request->company_name != null && $request->company_name != ''){
            $resp ->where("c.company_name", "=", $request->company_name);
            
        }
        if(isset($request->username) && $request->username != null && $request->username != ''){
            $resp ->where("c.username", "like", "%".$request->username."%");
            
        }
        if(isset($request->code) && $request->code != null && $request->code != ''){
            $resp ->where("c.codes", "=", $request->code);
            
        }
        if(isset($request->registration_no) && $request->registration_no != null && $request->registration_no != ''){
            $resp ->where("c.registration_no", "=", $request->registration_no);
            
        }
        if(isset($request->office_no) && $request->office_no != null && $request->office_no != ''){
            $resp ->where("c.office_no", "=", $request->office_no);
            
        }
        if(isset($request->address) && $request->address != null && $request->address != ''){
            $resp ->where("c.address", "like", "%".$request->address."%");
            
        }
        if(isset($request->status) && $request->status != null && $request->status != ''){
            $resp ->where("c.status", "=", $request->status);
            
        } 
        if(isset($request->exhibition_id) && $request->exhibition_id != null && $request->exhibition_id != ""){
            $resp ->where("e.exhibition_id",  "=", $request->exhibition_id);
        }
        if(isset($request->category_id) && $request->category_id != null && $request->category_id != ""){
            $resp ->where("c.category_id",  "=", $request->category_id);
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

        $resp->groupBy("c.company_id", "c.company_name", "c.office_no", "c.category_id", "ca.name");
        $resp->orderBy("c.company_id");
        
        if($request->limit != null || $request->limit != ""){
            $limit = $request->limit;

            $result = $resp->paginate($limit);

            return response()->json($result, 200);
        }
        
        $result = $resp->get();
        
        return response()->json($result, 200);
		
    }
    
    public function getEventSales(Request $request){
        $cid = $request->company_id;
        
        
        $limit = null;

        if($request->limit != null || $request->limit != ""){
            $limit = $request->limit;
        }

        $resp = DB::table("homes_companies as c")
        ->select("c.company_id", "c.company_name", "c.office_no", "e.exhibition_id as EventID", "e.title as EventTitle", "e.date as StartDt", "e.end_date as EndDt", DB::raw("COUNT(o.order_id) as totalSales"),
         DB::raw("SUM(o.amount) as totalAmount"), DB::raw("SUM(o.deposit_amount) as totalDeposit") )
        ->join("homes_orders as o", "o.company_id", "=", "c.company_id")
        ->join("homes_exhibitions as e", "e.exhibition_id", "=", "o.event_id")
        ->where("c.company_id", "=", $cid);

        if($request->exhibition_id != null && $request->exhibition_id != ""){
            $resp->where("e.exhibition_id",  "=", $request->exhibition_id);
        }     

        $resp->groupBy("c.company_id", "c.company_name", "c.office_no", "e.exhibition_id", "e.title", "e.date", "e.end_date")
        ->orderBy("c.company_id");

        if($limit != null){
            $result = $resp->paginate($limit);

            return response()->json($result, 200);
        }    
        
        //$result = $resp->orderBy("c.company_name")
        $result = $resp->get();
        
        return response()->json($result, 200);
        
    }
    
    public function getCompanyDetails(Request $request){

        
        $resp = DB::table("homes_companies as c")
        ->select("c.company_id", "c.code as CompanyCode" , "c.company_name as CompanyName", "c.username as PIC", "c.address", "ca.name as category", "c.office_no", "c.hp_no", "c.status", "c.registration_no")
        ->leftJoin("category as ca", "ca.value", "=", "c.category_id")
        ->where("c.username", "!=", "0")
        ->whereNotNull("c.username");

        if($request != "" || $request != null){
            $limit = null;

            if($request->limit != null || $request->limit != ""){
                $limit = $request->limit;
            }

            if($request->company_id != "" || $request->company_id != null){
                $resp->where("c.company_id", $request->company_id);
            }
            if($request->company_name != "" || $request->company_name != null){
                $resp->where("c.company_name", $request->company_name);
            }
            if($request->username != "" || $request->username != null){
                $resp->where("c.username", $request->username);
            }
            if($request->code != "" || $request->code != null){
                $resp->where("c.code", $request->code);
            }
            
            $resp->orderBy("c.company_name");

            if($limit != null){
                $result = $resp->paginate($limit);

                return response()->json($result, 200);
            }    
        }

        $result = $resp->orderBy("c.company_name")
        ->get();
        
        return response()->json($result, 200);
        
    }

    public function resetCompanyPassword($id){

        $company = DB::table("homes_companies")
        ->where("company_id", $id)
        ->get();

        if($company->isEmpty()){
            return response()->json(["Message"=>"Company not found"], 404);
        }

        $newPassword = Str::random(12);
        $newPassword2 = Str::random(14);

        $password = bcrypt($newPassword);
        $secondaryPassword = bcrypt($newPassword2);

        $company->password = $password;
        $company->secondary_password = $secondaryPassword;
        $company->save();

        return response()->json(["company_email"=>$company->username, "password"=>$newPassword, "secondary_password"=>$secondaryPassword], 200);
    }

    public function getEventList(Request $request){

        $company_id = $request->company_id;

        $company = DB::table("homes_companies as c")
        ->select("c.company_name as CompanyName", "e.title as EventTitle")
        ->where("company_id", $company_id)
        ->get();
    }
}
