<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;


Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});
Route::resource('todo', TodoController::class);
