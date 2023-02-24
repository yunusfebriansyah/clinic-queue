@extends('patient.main')

@section('content')

@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="{{ url('storage/' . $user->photo) }}" class="w-100 rounded m-2" alt="{{ $user->name }}">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <form action="/patient/edit-profile" method="post" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required placeholder="Isi nama pasien">
            @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" required placeholder="Isi username pasien">
            @error('username')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="address">Alamat</label>
            <textarea rows="5" name="address" class="form-control @error('address') is-invalid @enderror" required placeholder="Isi alamat pasien">{{ old('address', $user->address) }}</textarea>
            @error('address')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="photo">Foto Profil</label>
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