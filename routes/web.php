<?php

use App\Http\Controllers\TodolistsController;
use App\Http\Controllers\TodoListUser;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Routes untuk pengguna yang belum login
Route::middleware(['guest'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('login');
    Route::post('/', [UserController::class, 'login'])->name('login.user');
    Route::get('/registation', [UserController::class, 'registation'])->name('registation');
    Route::post('/registation', [UserController::class, 'registationsubmit'])->name('registation.user');
});

// Routes untuk pengguna yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::middleware('IsLogin')->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/home', function () {
        return view('pageuser.home');
    })->name('home');
});

// Routes untuk pengguna dengan role 'admin'
Route::middleware(['auth', 'IsAdmin'])->group(function () {
    //TodolistsController nama controller nya dan index,store nama class yang ada di controller tersebut
    //name berfungsi untuk menamai element" do halaman lain, contoh nya action di post kita hanya mengetik route lalu dashboard.post contoh nya -> action="{{ route('dashboard.post') }}"
    //agar saat ingin ganti routing tidak usah satu persatu, tapi cukup route nya saja
    Route::get('/dashboard', [TodolistsController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [TodolistsController::class, 'store'])->name('dashboard.post');
    Route::put('/dashboard/{id}', [TodolistsController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/{id}', [TodolistsController::class, 'destroy'])->name('dashboard.delete');
});

// Routes untuk pengguna dengan role 'user'
Route::middleware(['auth', 'IsUser'])->group(function () {
    Route::get('/home', [TodoListUser::class, 'index'])->name('home'); 
    Route::post('/home', [TodoListUser::class, 'store'])->name('home.post'); 
    Route::put('/home/{id}', [TodoListUser::class, 'update'])->name('home.update'); 
    Route::delete('/home/{id}', [TodoListUser::class, 'destroy'])->name('home.delete'); 
});
