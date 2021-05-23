@extends('dashboard')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Blog Data</h1>
      </div>
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <form action="{{route('blog_store')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="card-header">
                  <h4>Insert New Blog Article</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label>Blog Title</label>
                    <input type="text" name="blog_title" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <select class="custom-select" name="category">
                        <option selected value="Insight">Insight</option>
                        <option value="Design Tips">Design Tips</option>
                        <option value="Tutorial">Tutorial</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Thumbnail Image</label>
                    <input type="file" accept="image/*" name="blog_thumbnail" class="form-control" required="" >
                  </div>
                  <div class="form-group mb-0">
                    <label>Description</label>
                    <textarea id="summernote" name="blog_desc" class="form-control" ></textarea>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary" type="submit">Submit</button>

                </div>
              </form>
            </div>
        </div>
    </section>
  </div>



@endsection
