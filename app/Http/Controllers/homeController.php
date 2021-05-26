<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function getdata(){
        $portfolio = DB::table('portfolio')->paginate(6);
        $blog = DB::table('blog')->paginate(6);
        return view('home',['portfolio'=>$portfolio, 'blog'=>$blog]);
    }
}
