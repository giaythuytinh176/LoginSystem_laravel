<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get("signup", [\App\Http\Controllers\UserController::class, "create"])->name("login.create");

Route::post("signup", [\App\Http\Controllers\UserController::class, "store"])->name("login.store");

Route::post("login", [\App\Http\Controllers\UserController::class, "Auth"])->name("login.login");

Route::get("list", [\App\Http\Controllers\UserController::class, "showList"])->name("list");
Route::get("index", [\App\Http\Controllers\UserController::class, "index"]);


Route::get("logout", [\App\Http\Controllers\UserController::class, "logout"])->name("logout");






//Route::middleware("AuthUser")->group(function () {
//    Route::get("list", [\App\Http\Controllers\UserController::class, "showList"])->name("list");
//
//});

//Route::get('/confirm-password', function () {
//    return view('auth.confirm-password');
//})->middleware('auth')->name('password.confirm');
//
//Route::post('/confirm-password', function (Request $request) {
//    if (! Hash::check($request->password, $request->user()->password)) {
//        return back()->withErrors([
//            'password' => ['The provided password does not match our records.']
//        ]);
//    }
//
//    $request->session()->passwordConfirmed();
//
//    return redirect()->intended();
//})->middleware(['auth', 'throttle:6,1'])->name('password.confirm');
