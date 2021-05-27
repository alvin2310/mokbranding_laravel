@extends('layouts.app')

@section('content')
{{-- <section class="page_header">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <div class="col-lg-8">
                <h1 class="display-3">{!!$data->blog_title!!}</h1>
            </div>
      </div>
</section> --}}
<section class="inner-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 blogview">
                <img src="{{asset('img/blog/'.$data->blog_thumbnail)}}">
                <h1 class="display-4">{!!$data->blog_title!!}</h1>
                <h6 class="author">By Denny Santoso | {{$data->create_at}}</h6>
                <div class="blogview">
                    {!!$data->blog_desc!!}
                </div>
            </div>
        </div>
    </div>
  </section>

@endsection
