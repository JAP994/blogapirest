<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:55',
            'lastname' => 'required',
            'image' => 'required',
            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors(), 'status'=>"401"], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $token = $user->createToken('blog')->accessToken;
        return response()->json(['user'=> $user, 'access_token' => $token], 200); 
    }

    public function login(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['error'=>'These credentials do not match our records.', 'status'=>"401"], 401);
            }
        
            $token = $user->createToken('blog')->accessToken;
        
            $response = [
                'user' => $user,
                'token' => $token
            ];
        
             return response($response, 201);
    }

    public function logout(){
        $user = auth()->user();
        $user->tokens->each(function ($token, $key){
            $token->delete();
        });
        return response()->json(['res' => true, 'message' => "Usted ha salido del sistema"]);
    }
}
