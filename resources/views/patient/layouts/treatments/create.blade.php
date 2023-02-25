@extends('patient.main')

@section('content')
@if( session('message') )
  {!! session('message') !!}
@endif

@if( $is_open )

<div class="card shadow mb-4 mt-3">
  <div class="card-body">

    <form action="/patient/registers" method="post">
      @csrf
      <div class="form-group">
        <label for="service_id">Pilih Layanan</label>
        <select name="service_id" id="service_id" class="form-control">
          @foreach ($services as $service)
              <option value="{{ $service->id }}" {{ $service->id == old('service_id') ? 'selected' : '' }}>{{ $service->name }}</option>
          @endforeach
        </select>
        @error('service_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="complaint">Tulis Keluhan</label>
        <textarea rows="5" name="complaint" id="complaint" class="form-control  @error('complaint') is-invalid @enderror" placeholder="Isi keluhan anda">{{ old('complaint') }}</textarea>
        @error('complaint')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success px-4">Daftar</button>
      </div>
    </form>

  </div>
</div>

@else
<p>Pendaftaran belum dibuka</p>
@endif

@endsection