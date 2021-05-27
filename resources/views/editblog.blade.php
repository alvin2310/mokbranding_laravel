@extends('dashboard')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Edit Blog Data</h1>
      </div>
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <form action="{{route('blog_update',$blog->id)}}" method="POST" enctype="multipart/form-data" >
                @csrf
                @method('patch')
                <div class="card-header">
                  <h4>Insert New Blog Article</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label>Blog Title</label>
                    <input type="text" name="blog_title" class="form-control" required="" value="{{$blog->blog_title}}">
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <select class="custom-select" name="category" id="category">
                        <option  value="Insight" {{$blog->category == 'Insight' ? 'selected' : ''}}>Insight</option>
                        <option value="Design Tips" {{$blog->category == 'Design Tips' ? 'selected' : ''}}>Design Tips</option>
                        <option value="Tutorial" {{$blog->category == 'Tutorial' ? 'selected' : ''}}>Tutorial</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Thumbnail Image</label>
                    <input type="file" accept="image/*" name="blog_thumbnail" class="form-control" >
                  </div>
                  <div class="form-group mb-0">
                    <label>Description</label>
                    <textarea id="editor" name="blog_desc" class="form-control" >
                        {{$blog->blog_desc}}
                    </textarea>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary" type="submit">Update</button>

                </div>
              </form>
            </div>
        </div>
    </section>
  </div>



@endsection
@push('after-script')
<script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('editor', {
        filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endpush
