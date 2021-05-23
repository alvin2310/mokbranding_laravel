@extends('layouts.app')

@section('content')
<div>
    <h1>{!!$data->blog_title!!}</h1>
    <br>
    {!!$data->blog_desc!!}
</div>
@endsection
