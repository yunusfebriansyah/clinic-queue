@extends('admin.main')

@section('content')
@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="card-body">

    <form action="/administrator/services/{{ $service->id }}" method="post">
      @csrf
      @method('put')
      <div class="form-group">
        <label for="name">Nama Layanan</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $service->name) }}" required placeholder="Isi nama layanan">
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="description">Deskripsi Layanan</label>
        <textarea rows="5" name="description" id="description" class="form-control  @error('description') is-invalid @enderror" placeholder="Isi deskripsi layanan">{{ old('description', $service->description) }}</textarea>
        @error('description')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input  @error('is_lab') is-invalid @enderror" id="is_lab" name="is_lab" {{ $service->is_lab ? 'checked' : '' }}>
          <label class="custom-control-label" for="is_lab">Layanan laboratorium</label>
          @error('is_lab')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success px-4">Ubah</button>
      </div>
    </form>

  </div>
</div>



@endsection