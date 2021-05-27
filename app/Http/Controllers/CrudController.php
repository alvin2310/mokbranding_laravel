<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
Use Illuminate\Support\Str;
use Path\To\DOMDocument;
use Intervention\Image\ImageManagerStatic as Image;

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
        return redirect()->route('dashboard')->with('message','Data Berhasil Disimpan!');
    }
    public function showdata(){
        $portfolio = DB::table('portfolio')->paginate(5);
        $blog = DB::table('blog')->paginate(5);
        return view('data',['portfolio'=>$portfolio, 'blog'=>$blog]);
    }
    public function showblogdata(){
        $blog = DB::table('blog')->paginate(5);
        return view('blogdata',['blog'=>$blog]);
    }
    public function delete_porto($id){
        $data =  DB::table('portfolio')->where('id',$id);
        $path = 'img/portfolio';
        $file_path = public_path().$path.$data->port_img;
        DB::table('portfolio')->where('id',$id)->delete();


        return redirect()->back()->with('message','Data Berhasil Dihapus!');
    }
    public function delete_blog($id){
        $data =  DB::table('blog')->where('id',$id)->first();
        $old = $data->blog_thumbnail;
        Storage::delete('/img/blog/'.$old);
        DB::table('blog')->where('id',$id)->delete();

        return redirect()->back()->with('message','Data Berhasil Dihapus!');
    }

    public function edit_blog($id){
        $data = DB::table('blog')->where('id',$id)->first();
        return view('editblog',['blog'=>$data]);
    }
    public function update_blog(Request $request,$id){
        libxml_use_internal_errors(true);
        $todayDate = Carbon::now();
        $description = $request->input('blog_desc');
        $dom = new \DomDocument();
        $dom->encoding = 'utf-8';
        $dom->loadHtml(utf8_decode($description), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        // foreach($images as $key => $img){
        //     $data = $img->getAttribute('src');
        //     if (preg_match('/data:image/',$data)){
        //         preg_match('/data:image\/(?<mime>.*?)\;/', $data, $groups);
        //         $mime_type=$groups['mime'];
        //         $path = '/img/blog/' . uniqid('', true) . '.' . $mime_type;

        //         $dataimage = Image::make($data)
        //         ->resize(750, null, function ($constraint) {
        //             $constraint->aspectRatio();
        //         })
        //         ->encode($mime_type, 80)
        //         ->save(public_path($path));
        //         $img->removeAttribute('src');
        //         $img->setAttribute('src', asset($path));


        //         // $img->removeAttribute('src');
        //         // $img->setAttribute('src', '/img/blog/'.$image_name);
        //     }
        // }

        $description = utf8_decode($dom->saveHTML($dom->documentElement));
        if ($request->hasFile('blog_thumbnail')) {
            $file = $request->file('blog_thumbnail');
            $upload_path = 'img/blog';
            $file_name =time().$file->getClientOriginalName();
            $file->move($upload_path,$file_name);
            DB::table('blog')->where('id',$id)->update([
                'blog_title' => $request->blog_title,
                // 'blog_desc' =>$description,
                'blog_desc' =>$request->blog_desc,
                'create_at' => $todayDate,
                'category' => $request->category,
                'slug' => Str::slug($request->blog_title).$id,
                'plain_desc' => strip_tags($request->blog_desc),
                'blog_thumbnail' => $file_name,
            ]);
        }
        else{
            DB::table('blog')->where('id',$id)->update([
                'blog_title' => $request->blog_title,
                // 'blog_desc' =>$description,
                'blog_desc' =>$request->blog_desc,
                'create_at' => $todayDate,
                'category' => $request->category,
                'slug' => Str::slug($request->blog_title).time(),
                'plain_desc' => strip_tags($request->blog_desc),
            ]);
        }
        return redirect()->route('blogdata');


    }


}
