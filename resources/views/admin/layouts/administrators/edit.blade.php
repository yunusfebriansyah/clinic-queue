@extends('admin.main')

@section('content')

<a href="/administrator/users/administrators/create" class="btn btn-success">Tambah Data Administrator</a>
@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="{{ url('storage/' . $administrator->photo) }}" class="w-100 rounded m-2" alt="{{ $administrator->name }}">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        
        <form action="/administrator/users/administrators/{{ $administrator->id }}" method="post">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $administrator->name) }}" required placeholder="Isi nama dokter">
            @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $administrator->username) }}" required placeholder="Isi username dokter">
            @error('username')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <p class="text-danger font-weight-bold">*password diubah sesuai username</p>
          <div class="form-group">
            <button type="submit" class="btn btn-success px-4">Ubah</button>
          </div>
          
        </form>

      </div>
    </div>
  </div>
</div>



@endsection