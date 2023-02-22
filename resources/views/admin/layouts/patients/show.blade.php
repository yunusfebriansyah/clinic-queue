@extends('admin.main')

@section('content')

<a href="/administrator/users/patients/create" class="btn btn-success">Tambah Data Pasien</a>
@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="{{ url('storage/' . $patient->photo) }}" class="w-100 rounded m-2" alt="{{ $patient->name }}">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        
        <dl class="row">
          <dt class="col-sm-3">Nama</dt>
          <dd class="col-sm-9">: {{ $patient->name }}</dd>
          <dt class="col-sm-3">Username</dt>
          <dd class="col-sm-9">: {{ $patient->username }}</dd>
          <dt class="col-sm-3">Alamat</dt>
          <dd class="col-sm-9">: {{ $patient->address }}</dd>
        </dl>
        <a href="/administrator/users/patients/{{ $patient->id }}/edit" class="btn btn-sm btn-success">ubah</a>
        <form action="/administrator/users/patients/{{ $patient->id }}" class="d-inline" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-danger">hapus</button>
        </form>

      </div>
    </div>
  </div>
</div>



@endsection