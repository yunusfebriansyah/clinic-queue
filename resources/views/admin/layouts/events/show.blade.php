@extends('admin.main')

@section('content')

<a href="/administrator/events/create" class="btn btn-success">Tambah Data Kegiatan</a>
@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="{{ url('storage/' . $event->photo) }}" class="w-100 rounded m-2" alt="{{ $event->name }}">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        
        <dl class="row">
          <dt class="col-sm-3">Nama Kegiatan</dt>
          <dd class="col-sm-9">: {{ $event->name }}</dd>
          <dt class="col-sm-3">Deskripsi Kegiatan</dt>
          <dd class="col-sm-9">: {{ $event->description }}</dd>
        </dl>
        <a href="/administrator/events/{{ $event->id }}/edit" class="btn btn-sm btn-success">ubah</a>
        <form action="/administrator/events/{{ $event->id }}" class="d-inline" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-danger">hapus</button>
        </form>

      </div>
    </div>
  </div>
</div>



@endsection