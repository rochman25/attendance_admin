<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function index(){
        return view('pages.auth.login');
    }

    public function authenticate(Request $request){
        $request->validate([
            "username" => "required|string",
            "password" => "required"
        ]);
        try {
            //code...
            $credentials = $request->only('username','password');
            if(Auth::attempt($credentials)){
                $request->session()->regenerate();
                return redirect()->route('home.view')->with('success','Selamat Datang!.');
            }

            return back()->withErrors([
                "error" => 'Mohon maaf username tidak ditemukan atau password salah.'
            ]);
        } catch (\Exception $th) {
            //throw $th;
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

}
