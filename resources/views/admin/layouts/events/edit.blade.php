@extends('admin.main')

@section('content')
@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="card-body">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="{{ asset('/storage/' . $event->photo) }}" class="w-100 rounded" alt="{{ $event->name }}">
      </div>
      <div class="col-md-8">
        <form action="/administrator/events/{{ $event->id }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $event['name']) }}" required placeholder="Isi nama kegiatan">
            @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea rows="5" name="description" class="form-control @error('description') is-invalid @enderror" required placeholder="Isi deskripsi kegiatan">{{ old('description', $event['description']) }}</textarea>
            @error('description')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="photo">Foto Kegiatan</label>
            <small class="text-dark font-weight-bold d-block">*kosongkan jika tidak mengubah foto</small>
            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
            @error('photo')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success px-4">Ubah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



@endsection