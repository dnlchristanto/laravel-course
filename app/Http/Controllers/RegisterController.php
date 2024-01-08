<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index',[
            'title'=>'register'
        ]);
    }

    public function store(Request $request):RedirectResponse
    {
        //validation form
        $this->validate($request,[
            'name'=>'required|min:3',
            'email'=>'required|email:rfc,dns|unique:users',
            'password'=>'required|min:5|max:20'
        ]);

        //create ke database
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            //'password'=>bcrypt($request->password)
            'password'=>Hash::make($request->password)
        ]);

        //return redirect()->route('login.index');
        return redirect('/');
    }
}
