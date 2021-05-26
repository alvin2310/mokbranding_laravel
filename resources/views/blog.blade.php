@extends('layouts.app')

@section('content')

<section class="inner-page">
    <div class="container">
        <div class="container" data-aos="fade-up">

            <div class="row">
                    @foreach($blog as $blogdata)
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="400">
                        <div class="blog card">
                        <img src="{{asset('img/blog/'.$blogdata->blog_thumbnail)}}" class="card-img-top img-responsive" style="width:100%;height: 15vw;object-fit:cover;" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-truncate">{{ $blogdata->blog_title }}</h5>
                            <p class="card-text text-truncate">{{ $blogdata->plain_desc }}</p>
                            <a href="#" class="">Read More</a>
                        </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="blog-pagination justify-content-center">
                        {{$blog->links()}}
                    </div>
            </div>
        </div>
    </div>
  </section>



@endsection
