@extends('admin.main')

@section('content')

<a href="/administrator/users/doctors/create" class="btn btn-success">Tambah Data Dokter</a>
@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="{{ url('storage/' . $doctor->photo) }}" class="w-100 rounded m-2" alt="{{ $doctor->name }}">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        
        <dl class="row">
          <dt class="col-sm-3">Nama Dokter</dt>
          <dd class="col-sm-9">: {{ $doctor->name }}</dd>
          <dt class="col-sm-3">Username Dokter</dt>
          <dd class="col-sm-9">: {{ $doctor->username }}</dd>
          <dt class="col-sm-3">Spesialis Dokter</dt>
          <dd class="col-sm-9">: {{ $doctor->specialist }}</dd>
          <dt class="col-sm-3">Jam Kerja Dokter</dt>
          <dd class="col-sm-9">: {{ $doctor->practice_time }}</dd>
        </dl>
        <a href="/administrator/users/doctors/{{ $doctor->id }}/edit" class="btn btn-sm btn-success">ubah</a>
        <form action="/administrator/users/doctors/{{ $doctor->id }}" class="d-inline" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-danger">hapus</button>
        </form>

      </div>
    </div>
  </div>
</div>



@endsection