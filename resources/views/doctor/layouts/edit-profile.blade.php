@extends('doctor.main')

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
        <form action="/doctor/edit-profile" method="post" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required placeholder="Isi nama dokter">
            @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" required placeholder="Isi username dokter">
            @error('username')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="specialist">Spesialis</label>
            <input type="text" name="specialist" class="form-control @error('specialist') is-invalid @enderror" value="{{ old('specialist', $user->specialist) }}" required placeholder="Isi spesialis dokter">
            @error('specialist')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="practice_time">Jam Kerja</label>
            <textarea rows="5" name="practice_time" class="form-control @error('practice_time') is-invalid @enderror" required placeholder="Isi jam kerja dokter">{{ old('practice_time', $user->practice_time) }}</textarea>
            @error('practice_time')
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