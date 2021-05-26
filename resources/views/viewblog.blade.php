@extends('layouts.app')

@section('content')
<section class="inner-page">
    <div class="container">
        <div class="container" data-aos="fade-up">
            <h1>{!!$data->blog_title!!}</h1>
            <br>
            {!!$data->blog_desc!!}
        </div>
    </div>
  </section>

@endsection
