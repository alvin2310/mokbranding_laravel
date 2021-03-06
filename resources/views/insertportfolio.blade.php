@extends('dashboard')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Portfolio Data</h1>
      </div>
      <div class="col-12 col-md-12 col-lg-12">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
              <form action="{{route('port_simpan')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="card-header">
                  <h4>Insert New Portfolio</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label>Portfolio Name</label>
                    <input type="text" name="port_name" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Client Name</label>
                    <input type="text" name="port_client" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Portfolio Image</label>
                    <input type="file" accept="image/*" name="port_img" class="form-control" required="" >
                  </div>
                  <div class="form-group mb-0">
                    <label>Description</label>
                    <textarea class="form-control" name="port_description" required=""></textarea>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary" type="submit">Submit</button>
                </div>
              </form>
            </div>
      <div class="section-body">
      </div>
    </section>
  </div>


@endsection
