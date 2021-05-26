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
              <h4>Blog Data</h4>
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
                <thead class="align-middle">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Blog Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Thumbnail</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach($blog as $index =>$blogs)

                  <tr>
                    <th scope="row">{{$blog->firstItem() + $index}}</th>
                    <td>{{ $blogs->blog_title }}</td>
                    <td style="max-width: 200px;text-overflow:ellipsis;overflow: hidden;white-space: nowrap;">{{ $blogs->plain_desc }}</td>
                    <td>{{ $blogs->category }}</td>
                    <td style="width:300px!important"><img src="{{asset('img/blog/'.$blogs->blog_thumbnail)}}" class="img-fluid img-thumbnail" style="width:100%;height: 7vw;object-fit:cover;" alt="{{ $blogs->blog_thumbnail }}"></td>
                    <td>
                        <a href="{{route('viewblog',$blogs->slug)}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-newspaper"></i>View</a>
                        <a href="{{route('blog_edit',$blogs->id)}}" class="btn btn-icon icon-left btn-warning"><i class="far fa-edit"></i>Edit</a>
                        <a href="#" class="btn btn-icon icon-left btn-danger swal-confirm" data-id="{{$blogs->id}}">
                            <form action="{{route('blog_delete',$blogs->id)}}" id="delete{{$blogs->id}}" method="POST">
                            @csrf
                            @method('delete')
                            </form>
                            <i class="fa fa-trash"></i>
                            Delete</a>
                    </td>
                    </td>

                </tr>

                  @endforeach
                </tbody>
              </table>
              <div class="card-footer">
                    {{$blog->links()}}
              </div>
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
