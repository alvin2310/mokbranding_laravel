<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CrudController extends Controller
{
    //simpan data
    public function simpanPortfolio(Request $request){
        $file = $request->file('port_img');
        $upload_path = 'img/portfolio';
        $file_name = $file->getClientOriginalName();
        $file->move($upload_path,$file->getClientOriginalName());
        $todayDate = Carbon::now();
        DB::table('portfolio')->insert([
            'port_name' => $request->port_name,
            'port_client' =>$request->port_name,
            'port_description' => $request->port_description,
            'create_at' => $todayDate,
            'port_img' => $file_name
        ]);
        return redirect()->route('dashboard');
    }
    public function showdata(){
        $portfolio = DB::table('portfolio')->get();
        $blog = DB::table('blog')->get();
        return view('data',['portfolio'=>$portfolio, 'blog'=>$blog]);
    }

}
