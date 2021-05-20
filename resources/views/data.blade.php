@extends('dashboard')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Mok Branding Data</h1>
      </div>
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
              <h4>Portfolio Data</h4>
            </div>
            <div class="card-body">
              <table class="table table-image">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Porfilio Name</th>
                    <th scope="col">Client</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($portfolio as $porto)
                  <tr>
                    <th scope="row">1</th>
                    <td>{{ $porto->port_name }}</td>
                    <td>{{ $porto->port_client }}</td>
                    <td>{{ $porto->port_description }}</td>
                    <td style="width:300px!important"><img src="{{asset('img/portfolio/'.$porto->port_img)}}" class="img-fluid img-thumbnail" style="width:100%;" alt="{{ $porto->port_name }}"></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
      </div>
      <div class="section-body">
      </div>
    </section>
  </div>


@endsection
