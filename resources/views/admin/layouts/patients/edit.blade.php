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
        
        <form action="/administrator/users/patients/{{ $patient->id }}" method="post">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $patient->name) }}" required placeholder="Isi nama pasien">
            @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $patient->username) }}" required placeholder="Isi username pasien">
            @error('username')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="address">Alamat</label>
            <textarea rows="5" name="address" class="form-control @error('address') is-invalid @enderror" required placeholder="Isi alamat pasien">{{ old('address', $patient->address) }}</textarea>
            @error('address')
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