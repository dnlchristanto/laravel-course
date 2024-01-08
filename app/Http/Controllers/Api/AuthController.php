<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class AuthController extends Controller
{
    public function createUser(Request $request)
    {
        Try{
            //validation form
            $validator=Validator::make($request->all(),[
                'name'=>'required|min:3',
                'email'=>'required|email:rfc,dns|unique:users',
                'password'=>'required|min:5|max:20'
            ]);

            //check if validation failed
            if($validator->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'validation error',
                    'error'=>$validator->errors()
                ],422);
            }

            //create ke database
            $user=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                //'password'=>bcrypt($request->password)
                'password'=>Hash::make($request->password)
            ]);

            //return responnya
            return response()->json(['status'=>true,
                'message'=>'register user',
                'data'=>$user,
                'token'=>$user->createToken("API TOKEN USER")->plainTextToken
            ],200);
        }
        catch(\Throwable $th){
            //return responnya
            return response()->json(['status'=>false,
                'message'=>'register user failed'.$th->getMessage()
            ],422);
        }
    }

    public function loginUser(Request $request)
    {
        try{
            //validation form
            $validator=Validator::make($request->all(),[
                'email'=>'required|email:rfc,dns',
                'password'=>'required'
            ]);

            //check if validation failed
            if($validator->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'validation error',
                    'error'=>$validator->errors()
                ],422);
            }

            if (!Auth::attempt($request->only(['email','password'])))
            {
                return response()->json([
                    'status'=>false,
                    'message'=>'The provided credentials do not match with our records'
                ],401);
            }

            $user=User::where('email',$request->email)->first();

            //return responnya
            return response()->json([
                'status'=>true,
                'message'=>'login user berhasil',
                'data'=>$user,
                'token'=>$user->createToken("API TOKEN USER")->plainTextToken
            ],200);

            return back()->withErrors([
                'email'=>'The provided credentials do not match with our records',
            ])->onlyInput('email');
        }
        catch(\Throwable $th){
            //return responnya
            return response()->json(['status'=>false,
                'message'=>'register user failed'.$th->getMessage()
            ],422);
        }

    }
}
