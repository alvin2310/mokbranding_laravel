<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
Use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('insertblog');
    }

    public function insert(Request $request){
        $file = $request->file('blog_thumbnail');
        $upload_path = 'img/blog';
        $file_name = $file->getClientOriginalName();
        $file->move($upload_path,$file->getClientOriginalName());
        $todayDate = Carbon::now();
        DB::table('blog')->insert([
            'blog_title' => $request->blog_title,
            'blog_desc' =>$request->blog_desc,
            'create_at' => $todayDate,
            'category' => $request->category,
            'blog_thumbnail' => $file_name,
            'slug' => Str::slug($request->blog_title),
        ]);
        return redirect('/dashboard/blog');
    }

    public function viewblog($slug){
        $data=DB::table('blog')->where('slug',$slug)->first();
        return view('viewblog',compact('data'));
    }

    public function getdata(){
        $blog = DB::table('blog')->paginate(5);
        return view('blog',['blog'=>$blog]);
    }

    public function uploadImage(Request $request) {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('img/blog/'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('img/blog/'.$fileName);
            $msg = 'Image successfully uploaded';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
           }
       }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('blog_thumbnail');
        $todayDate = Carbon::now();
        $upload_path = 'img/blog';
        $file_name =time().$file->getClientOriginalName();
        $file->move($upload_path,$file_name);
        $description = $request->input('blog_desc');
        $dom = new \DomDocument();
        $dom->encoding = 'utf-8';
        $dom->loadHtml(utf8_decode($description), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');
        // foreach($images as $key => $img){
        //     $data = $img->getAttribute('src');

        //     list($type, $data) = explode(';', $data);
        //     list(, $data)      = explode(',', $data);
        //     $data = base64_decode($data);

        //     $image_name=time().$key.'.png';
        //     $path = public_path().'/img/blog/'.$image_name;

        //     file_put_contents($path, $data);

        //     $img->removeAttribute('src');
        //     $img->setAttribute('src', '/img/blog/'.$image_name);
        // }

        $description = utf8_decode($dom->saveHTML($dom->documentElement));


        DB::table('blog')->insert([
            'blog_title' => $request->blog_title,
            // 'blog_desc' =>$description,
            'blog_desc' =>$request->blog_desc,
            'create_at' => $todayDate,
            'category' => $request->category,
            'blog_thumbnail' => $file_name,
            'slug' => Str::slug($request->blog_title).time(),
            'plain_desc' => strip_tags($request->blog_desc),
        ]);
        return redirect('/dashboard/blog');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }


}
