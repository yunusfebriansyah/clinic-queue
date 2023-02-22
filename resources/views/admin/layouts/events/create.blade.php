@extends('admin.main')

@section('content')
@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="card-body">

    <form action="/administrator/events" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Isi nama kegiatan">
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea rows="5" name="description" class="form-control @error('description') is-invalid @enderror" required placeholder="Isi deskripsi kegiatan">{{ old('description') }}</textarea>
        @error('description')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="photo">Foto Kegiatan</label>
        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
        @error('photo')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success px-4">Tambah</button>
      </div>
    </form>

  </div>
</div>



@endsection