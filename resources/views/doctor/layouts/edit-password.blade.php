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
        <form action="/doctor/change-password" method="post">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="old_password">Password Lama</label>
            <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" value="{{ old('old_password') }}" placeholder="Isi password lama">
            @error('old_password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="new_password">Password Baru</label>
            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" value="{{ old('new_password') }}" placeholder="Isi password baru">
            @error('new_password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="confirm_password">Konfirmasi Password Baru</label>
            <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" value="{{ old('confirm_password') }}" placeholder="Isi konfirmasi password baru">
            @error('confirm_password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success px-4">Ganti Password</button>
          </div>
          
        </form>

      </div>
    </div>
  </div>
</div>



@endsection