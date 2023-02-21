@extends('admin.main')

@section('content')

<a href="/administrator/services/create" class="btn btn-success">Tambah Layanan</a>
@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="card-body">


    <dl class="row">
      <dt class="col-sm-3">Nama Layanan</dt>
      <dd class="col-sm-9">: {{ $service->name }}</dd>
      <dt class="col-sm-3">Status Layanan Laboratorium</dt>
      <dd class="col-sm-9">: 
        @if ( $service->is_lab )
        <i class="fas fa-check-circle text-success"></i>
        @else
        <i class="fas fa-times-circle text-danger"></i>
        @endif
      </dd>
      <dt class="col-sm-3">Deskripsi Layanan</dt>
      <dd class="col-sm-9">: {{ $service->description }}</dd>
    </dl>
    <a href="/administrator/services/{{ $service->id }}/edit" class="btn btn-sm btn-success">ubah</a>
    <form action="/administrator/services/{{ $service->id }}" class="d-inline" method="post">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-sm btn-danger">hapus</button>
    </form>
  </div>
</div>



@endsection