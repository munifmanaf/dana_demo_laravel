<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use mod_lti\local\ltiservice\response;

class RegisterController extends Controller
{
    public function register(){
        return view('register');
    }

    public function save_user(Request $request){
        $user = User::where('no_ic', $request['ic'])->first();

        if($user){
            return response()->json(['exists' => 'IC already exists']);
        }else{
            $user = new User;
            $user->no_ic = $request['ic'];
            $user->name = $request['name'];
            $user->password = bcrypt($request['password']);
            $user->phone_no = $request['phone_no'];
            $user->address = $request['address'];
            // dd($request);
            $user->save();
            return response()->json(['success' => 'User Registered Successfully']);
        }
    }
}
