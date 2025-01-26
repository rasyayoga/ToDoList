<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('login');
    }

    // public function dashboarduser()
    // {
    //     return view('pageuser.home');
    // }

    
    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required' => 'silahkan isi username',
            'password.required' => 'silahkan isi password',
        ]);

        $cekLogin = [
            'username' => $request->username,
            'password'=>$request->password,
        ];

        if(Auth::attempt($cekLogin)){
            $role = Auth::user();
            if ($role->role == 'admin') {
                return redirect()->route('dashboard');
            }
            if ($role->role == 'user') {
                return redirect()->route('home');
            }
        }else {
            return redirect()->back()->withErrors(['login_failed' => 'Proses login gagal, silakan coba lagi dengan data yang benar!'])->withInput();
        };
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda telah berhasil logout!');
    }
}
