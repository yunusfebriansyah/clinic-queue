@extends('doctor.main')

@section('content')

@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="{{ url('storage/' . $treatment->patient->photo) }}" class="w-100 rounded m-2" alt="{{ $treatment->patient->name }}">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <dl class="row">
          <dt class="col-sm-3">Nama Pasien</dt>
          <dd class="col-sm-9">: {{ $treatment->patient->name }}</dd>
          <dt class="col-sm-3">Alamat Pasien</dt>
          <dd class="col-sm-9">: {{ $treatment->patient->address }}</dd>
          <dt class="col-sm-3">Keluhan</dt>
          <dd class="col-sm-9">: {{ $treatment->complaint }}</dd>
          <dt class="col-sm-3">Layanan</dt>
          <dd class="col-sm-9">: {{ $treatment->service->name }}</dd>
          <dt class="col-sm-3">Penyakit</dt>
          <dd class="col-sm-9">: {{ $treatment->disease->name }}</dd>
          <dt class="col-sm-3">Status Pengobatan</dt>
          <dd class="col-sm-9 font-weight-bold text-info">: {{ $treatment->status }}</dd>
          <dt class="col-sm-3">Waktu Pengobatan</dt>
          <dd class="col-sm-9">: {{ $treatment->created_at->diffForHumans() }}</dd>
        </dl>
        <form method="post" action="/doctor/treatments/{{ $treatment->id }}">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="disease_id">Pilih Penyakit</label>
            <select name="disease_id" id="disease_id" class="form-control @error('disease_id') is-invalid @enderror">
              @foreach( $diseases as $disease )
              <option value="{{ $disease->id }}">{{ $disease->name }}</option>
              @endforeach
            </select>
            @error('disease_id')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">Selesai</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
</div>


@endsection