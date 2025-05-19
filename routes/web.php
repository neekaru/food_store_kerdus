<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', Auth\Register::class)->name('register');
Route::get('/login', Auth\Login::class)->name('login');