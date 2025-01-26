<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function registation()
    {
        return view('registation');
    }
    public function registationsubmit(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8',
        ]);
    
        // Periksa apakah name sudah ada
        if (User::where('username', $request->username)->exists()) {
            return redirect()->back()->withErrors(['name' => 'Name sudah digunakan. Silakan pilih nama lain.'])->withInput();
        }
    
        // Buat user baru
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->role = 'user';
        $user->save();
    
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
    

    
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
