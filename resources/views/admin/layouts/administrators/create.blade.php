@extends('admin.main')

@section('content')
@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="card-body">

    <form action="/administrator/users/administrators" method="post">
      @csrf
      <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Isi nama dokter">
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required placeholder="Isi username dokter">
        @error('username')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <p class="text-danger font-weight-bold">*password dibuat sesuai username</p>
      <div class="form-group">
        <button type="submit" class="btn btn-success px-4">Tambah</button>
      </div>
    </form>

  </div>
</div>



@endsection