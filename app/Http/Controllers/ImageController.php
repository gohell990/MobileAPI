<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
// use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use Carbon\Carbon;

class ImageController extends Controller
{
    //
    
    public function index(Request $request){
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        
        if($request->attachment == null || $request->attachment == ""){
            return response()->json(["Message"=>"Please enter a photo name"], 200);
        }

        $attachment = $request->attachment;

        if($request->event != null && $request->event != "" && $request->event == true){
            $image = DB::table("homes_photos")->select("photo")
            ->where("photo", "LIKE", "%".$attachment."%")
            ->get();

            $imageCreatedAt = DB::table("homes_photos")
            ->select("created_at")
            ->where("photo", "LIKE", "%".$attachment."%")
            ->get();
        }
        else{
            $image = DB::table("homes_orders")
            ->select("attachment")
            ->where("attachment", "LIKE", "%".$attachment."%")
            ->get();

            $imageCreatedAt = DB::table("homes_orders")
            ->select("created_at")
            ->where("attachment", "LIKE", "%".$attachment."%")
            ->get();
        }

        // ->toSql();

        if($image->isEmpty()){
            return response()->json(["Message"=>"Image Not Found"], 404);
        }

        $array = array();
        $array = explode(", ", $image);
        
        $link = "https://homeslivingapp.com/storage/app/public/";

        $result = array();
        $result = json_decode($imageCreatedAt, true);

        $directory = substr($result[0]['created_at'], 0, 7);
        $imageDate = Carbon::parse($directory)->format("Y-m");
        $date = Carbon::parse("2020-12")->format("Y-m");
        
        $returnData = array();
        $name = array();
        $value = array();
        if($imageDate < $date){
            if($request->event != null && $request->event != "" && $request->event == true){
                foreach($array as $key=>$value){
                    $name = json_decode($value, true);
                    $data = explode(",", $name[0]["photo"]);
                    
                    for($i = 0; $i<count($data); $i++){
                        $returnData[] = $link.$data[$i];
                    }
                }  
            }else{
                foreach($array as $key=>$value){
                    $name = json_decode($value, true);
                    $data = explode(",", $name[0]["attachment"]);
                    
                    for($i = 0; $i<count($data); $i++){
                        $returnData[] = $link.$data[$i];
                    }
                }  
            }
        }else{
            if($request->event != null && $request->event != "" && $request->event == true){
                foreach($array as $key=>$value){
                    $name = json_decode($value, true);
                    $data = explode(",", $name[0]["photo"]);
                    
                    for($i = 0; $i<count($data); $i++){
                        $returnData[] = $link.$directory."/".$data[$i];
                    }
                }
            }else{
                foreach($array as $key=>$value){
                    $name = json_decode($value, true);
                    $data = explode(",", $name[0]["attachment"]);
                    
                    for($i = 0; $i<count($data); $i++){
                        $returnData[] = $link.$directory."/".$data[$i];
                    }
                }
            }
        }

        return response()->json($returnData, 200); 
    }

    public function store(Request $request){
        $image = new Image();
        // $photoName = Carbon::now()->format("YmdHis");
        $thisDirectory = Carbon::now()->format("Y-m");

        if($request->event != null && $request->event != "" && $request->event == true){
            
            if($request->hasfile('image')){
=======
        $image = $request->name;
        // $user_id = $request->user_id;

        // $event = $request->event;

        // $contents = Storage::get($image);
        // $path = storage_path(); 
        $storagePath  = Storage::disk('local')->get($image.'.jpeg');
        $path = Storage::url($image);

        // $storagePath = storage_path('app/' . $image . '.jpeg');

        return response($path);

        // return Image::make($storagePath)->response();

        // $contents = Storage::disk('local')->get($image); 
        return response()->json(["StoragePath"=>$storagePath], 200);

        $path = storage_path("");
        $exists = Storage::disk('s3')->exists('file.jpg');
    }

    public function store(Request $request){
        $image = new Images();
>>>>>>> parent of 3b2132f (Image storage:link)

=======
        $image = $request->name;
        // $user_id = $request->user_id;

        // $event = $request->event;

        // $contents = Storage::get($image);
        // $path = storage_path(); 
        $storagePath  = Storage::disk('local')->get($image.'.jpeg');
        $path = Storage::url($image);

        // $storagePath = storage_path('app/' . $image . '.jpeg');

        return response($path);

        // return Image::make($storagePath)->response();

        // $contents = Storage::disk('local')->get($image); 
        return response()->json(["StoragePath"=>$storagePath], 200);

        $path = storage_path("");
        $exists = Storage::disk('s3')->exists('file.jpg');
    }

    public function store(Request $request){
        $image = new Images();

>>>>>>> parent of 3b2132f (Image storage:link)
        $rules = [
            "user_id" => "required|integer"
        ];
        
        $validator = Validator::make($request->all(), $rules);

<<<<<<< HEAD
<<<<<<< HEAD
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); //get image extension
                $fileName = time() . "." . $extension;
    
                $path = $request->file('image')->store('/public/'.$thisDirectory);

                $arrayPath = explode("/", $path); 
                // $imageName = 
                $image->photo = $arrayPath[2];

                $image->user_id = $adminId;
                $image->save();
                
                $id = $image->id;
    
                return response()->json(["message"=>"Photo created", "imageID"=>$image->id], 200);
            }
            else {
                
                $image->image = "";
                
                return response()->json(["message"=>"Please upload a photo"], 400);
            }
        }else{
            $rules = [
                "user_id" => "required|integer"
            ];
            
            $validator = Validator::make($request->all(), $rules);
    
            if($validator->fails()){
                return response()->json(["Message"=>$validator->errors()], 400);
            }

            if($request->hasfile('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); //get image extension
                $fileName = time() . "." . $extension;

                $path = $request->file('image')->store('/public/'.$thisDirectory);

                $arrayPath = explode("/", $path); 
                $image->photo = $arrayPath[2];

                $image->user_id = $request->user_id;
                
                $image->save();    

                return response()->json(["message"=>"Photo created", "imageID"=>$image->id], 200);
            }
            else {
                
                return response()->json(["Message"=>"Should upload image"], 400);
            }
=======
        if($validator->fails()){
            return response()->json(["Message"=>$validator->errors()], 400);
        }
        // $image->image = $request->input('image');

        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); //get image extension
            $fileName = time() . "." . $extension;
            // $file->move("https://portal.homeslivingapp.com/image/", $fileName);
            // $file->move("https://homeslivingapp.com/uploads/image/", $fileName);
            // Storage::move($fileName, "uploads/image/");
            Storage::put($request->user_id . Carbon::now(), $fileName);
            // $file->storeAs("uploads/image/", $fileName);
            // $image->image = $fileName;
            $image->photo = $fileName;
            $image->user_id = $request->user_id;
            
>>>>>>> parent of 3b2132f (Image storage:link)
        }
=======
        $image = $request->name;
        // $user_id = $request->user_id;

        // $event = $request->event;

        // $contents = Storage::get($image);
        // $path = storage_path(); 
        $storagePath  = Storage::disk('local')->get($image.'.jpeg');
        $path = Storage::url($image);

        // $storagePath = storage_path('app/' . $image . '.jpeg');

        return response($path);

        // return Image::make($storagePath)->response();

        // $contents = Storage::disk('local')->get($image); 
        return response()->json(["StoragePath"=>$storagePath], 200);

        $path = storage_path("");
        $exists = Storage::disk('s3')->exists('file.jpg');
    }

    public function store(Request $request){
        $image = new Images();

        $rules = [
            "user_id" => "required|integer"
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(["Message"=>$validator->errors()], 400);
        }
        // $image->image = $request->input('image');

        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); //get image extension
            $fileName = time() . "." . $extension;
            // $file->move("https://portal.homeslivingapp.com/image/", $fileName);
            // $file->move("https://homeslivingapp.com/uploads/image/", $fileName);
            // Storage::move($fileName, "uploads/image/");
            Storage::put($request->user_id . Carbon::now(), $fileName);
            // $file->storeAs("uploads/image/", $fileName);
            // $image->image = $fileName;
            $image->photo = $fileName;
            $image->user_id = $request->user_id;
            
        }
>>>>>>> parent of 3b2132f (Image storage:link)
=======
        if($validator->fails()){
            return response()->json(["Message"=>$validator->errors()], 400);
        }
        // $image->image = $request->input('image');

        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); //get image extension
            $fileName = time() . "." . $extension;
            // $file->move("https://portal.homeslivingapp.com/image/", $fileName);
            // $file->move("https://homeslivingapp.com/uploads/image/", $fileName);
            // Storage::move($fileName, "uploads/image/");
            Storage::put($request->user_id . Carbon::now(), $fileName);
            // $file->storeAs("uploads/image/", $fileName);
            // $image->image = $fileName;
            $image->photo = $fileName;
            $image->user_id = $request->user_id;
            
        }
>>>>>>> parent of 3b2132f (Image storage:link)
        else {
            
            return response()->json(["Message"=>"Should upload image"], 400);
        }

        // if($request->hasfile('image2')){
        //     $file = $request->file('image2');
        //     $extension = $file->getClientOriginalExtension(); //get image extension
        //     $fileName = time() . "." . $extension;
        //     $file->move("uploads/image/", $fileName);
        //     // $image->image = $fileName;
        //     $photo = $image->photo;
        //     $image->photo = $photo . ", ".$fileName;

        $image->save();    

        return response()->json(["message"=>"Photo created"], 200);
    }

    
    /*public function display(){
        $images = Image::all();

        return view("uploadform")->with('images', $images);
    }

    public function orderImage(){
        $images = DB::table("image")->orderBy('id', 'desc')->get();
        
        return response()->json($images);
        // return view("uploadform")->with("images", $images);
    }*/

    // public function login()
    // {
    //     $credentials = request(['email', 'password']);
    //     $token = auth()->attempt($credentials);

    //     if (!$token) {
    //         return response()->json(['Error' => 'Unauthorized ', "Credential"=>$credentials], 401);
    //     }

    //     $id = Auth::id();
    //     $user = User::find($id);

    //     if(!$user){
    //         return response()->json(['message'=>"User Id not found!"], 404);
    //     }

    //     if($user) {
    //         $user->remember_token = $token;
    //         $user->save();
    //     }

        
        
    //     session(['_token'=> $token]);

    //     return response()->json(["TOKEN"=>$token]);
    // }
}
