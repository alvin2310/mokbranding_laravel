<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\CrudController;
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
    Route::get('/dashboard',[CrudController::class, 'showdata'])->name('dashboard');
    Route::get('/dashboard/portfolio', function () {return view('insertportfolio');});
    Route::get('/dashboard/blog', function () {return view('insertblog');});
    Route::get('logout',[AuthController::class, 'logout'])->name('logout');
    Route::post('/dashboard/portfolio/submit',[CrudController::class, 'simpanPortfolio'])->name('port_simpan');
});


