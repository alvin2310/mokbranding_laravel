@extends('dashboard')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Blog Data</h1>
      </div>
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <form action="{{route('port_simpan')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="card-header">
                  <h4>Insert New Blog Article</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label>Blog Title</label>
                    <input type="text" name="port_name" class="form-control" required="">
                  </div>
                  <div class="form-group mb-0">
                    <label>Description</label>
                    <div id="summernote" class="form-group"></div>
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
