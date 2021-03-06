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
            @if(session('message'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>x</span>
                    </button>
                    {{session('message')}}
                </div>
            </div>
            @endif
            <div class="card-body">
              <table class="table table-image table-lg">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Porfilio Name</th>
                    <th scope="col">Client</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col" colspan="3">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1; ?>
                  @foreach($portfolio as $porto)

                  <tr>
                    <th scope="row">{{$no}}</th>
                    <td>{{ $porto->port_name }}</td>
                    <td>{{ $porto->port_client }}</td>
                    <td>{{ $porto->port_description }}</td>
                    <td style="width:300px!important"><img src="{{asset('img/portfolio/'.$porto->port_img)}}" class="img-fluid img-thumbnail" style="width:100%;height: 5vw;object-fit:cover;" alt="{{ $porto->port_name }}"></td>
                    <td>
                        <a href="" class="btn btn-icon icon-left btn-primary"><i class="far fa-newspaper"></i>View</a>
                        <a href="" class="btn btn-icon icon-left btn-warning"><i class="far fa-edit"></i>Edit</a>
                        <a href="#" class="btn btn-icon icon-left btn-danger swal-confirm" data-id="{{$porto->id}}">
                            <form action="{{route('port_delete',$porto->id)}}" id="delete{{$porto->id}}" method="POST">
                            @csrf
                            @method('delete')
                            </form>
                            <i class="fa fa-trash"></i>
                            Delete</a>
                    </td>
                </tr>
                  <?php $no++; ?>
                  @endforeach
                </tbody>
              </table>
              <div>{{$portfolio->links()}}</div>
            </div>
          </div>
      </div>
      <div class="section-body">
      </div>
    </section>
  </div>


@endsection

@push('after-script')
<script>
$(".swal-confirm").click(function(e) {
    id = e.target.dataset.id;
    swal({
        title: 'Are you sure To Delete This Data?',
        text: 'Once deleted, you will not be able to recover this Data!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
        swal('Poof! Your Data has been deleted!', {
          icon: 'success',
        });
        $(`#delete${id}`).submit();
        } else {
        swal('Your Data is safe!');
        }
      });
  });
</script>
@endpush
