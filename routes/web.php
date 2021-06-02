<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
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
Route::get('/blog', function () {
    return view('blog');
});

Route::get('/',[homeController::class, 'getdata']);
Route::get('/blog',[BlogController::class, 'getdata']);
Route::get('/login',[AuthController::class, 'showlogin']);
Route::post('login',[AuthController::class, 'login'])->name('login');
Route::get('/blog/{slug}',[BlogController::class, 'viewblog'])->name('viewblog');
Route::get('/portfolio',[homeController::class, 'viewportfolio'])->name('viewportfolio');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard',[CrudController::class, 'showdata'])->name('dashboard');
    Route::get('/dashboard/portfolio',[CrudController::class, 'showdata'])->name('portdata');
    Route::get('/dashboard/blog',[CrudController::class, 'showblogdata'])->name('blogdata');
    Route::get('/dashboard/insert-portfolio', function (){return view('insertportfolio');});
    Route::get('/dashboard/insert-blog', function (){return view('insertblog');});
    Route::get('/dashboard/insert-blogck', function (){return view('ckeditor');});
    Route::get('logout',[AuthController::class, 'logout'])->name('logout');
    Route::post('/dashboard/portfolio/submit',[CrudController::class, 'simpanPortfolio'])->name('port_simpan');
    Route::post('/dashboard/blog/submit',[BlogController::class, 'store'])->name('blog_store');
    Route::delete('/dashboard/portfolio/delete/{id}',[CrudController::class, 'delete_porto'])->name('port_delete');
    Route::delete('/dashboard/blog/delete/{id}',[CrudController::class, 'delete_blog'])->name('blog_delete');
    Route::get('dashboard/update/blog/{id}',[CrudController::class, 'edit_blog'])->name('blog_edit');
    Route::patch('dashboard/blog/update/{id}',[CrudController::class, 'update_blog'])->name('blog_update');
    Route::post('ckeditor/upload', 'BlogController@uploadImage')->name('ckeditor.image-upload');
});


