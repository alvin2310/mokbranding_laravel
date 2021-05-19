<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\homeController;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/',[homeController::class, 'getdata']);
Route::get('/login',[AuthController::class, 'showlogin']);
Route::post('login',[AuthController::class, 'login'])->name('login');
Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard', function () {return view('data');});
    Route::get('/dashboard/portfolio', function () {return view('insertportfolio');});
    Route::get('logout',[AuthController::class, 'logout'])->name('logout');
});


