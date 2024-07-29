<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function user_login(Request $request){
        // dd($request->all());
        if(Auth::attempt([
            'no_ic' => $request->input('ic'),
            'password' => $request->input('password')
        ])) {
            $user_data = DB::table('users')->where('no_ic', $request->input('ic'))->first();

            return response()->json(['success' => 'Successfully Logged In', 'is_admin' => $user_data->is_admin]);

        }else{
            return response()->json(['error' => 'Something Went Wrong']);
        }
    }
}
