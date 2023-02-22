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
        
        <form action="/administrator/users/doctors/{{ $doctor->id }}" method="post">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $doctor->name) }}" required placeholder="Isi nama dokter">
            @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $doctor->username) }}" required placeholder="Isi username dokter">
            @error('username')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="specialist">Spesialis</label>
            <input type="text" name="specialist" class="form-control @error('specialist') is-invalid @enderror" value="{{ old('specialist', $doctor->specialist) }}" required placeholder="Isi spesialis dokter">
            @error('specialist')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="practice_time">Jam Kerja</label>
            <input type="text" name="practice_time" class="form-control @error('practice_time') is-invalid @enderror" value="{{ old('practice_time', $doctor->practice_time) }}" required placeholder="Isi jam kerja dokter">
            @error('practice_time')
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