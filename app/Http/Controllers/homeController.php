<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function getdata(){
        $portfolio = DB::table('portfolio')->get();
        $blog = DB::table('blog')->get();
        return view('home',['portfolio'=>$portfolio, 'blog'=>$blog]);
    }
}
