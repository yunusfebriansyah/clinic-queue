@extends('patient.main')

@section('content')

@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="card-body">
    @if ( $treatment->status != 'menunggu konfirmasi' )
    <dl class="row">
      <dt class="col-sm-3">Keluhan</dt>
      <dd class="col-sm-9">: {{ $treatment->complaint }}</dd>
      <dt class="col-sm-3">Layanan</dt>
      <dd class="col-sm-9">: {{ $treatment->service->name }}</dd>
      <dt class="col-sm-3">Penyakit</dt>
      <dd class="col-sm-9">: {{ $treatment->disease->name }}</dd>
      <dt class="col-sm-3">Nama Dokter</dt>
      <dd class="col-sm-9">: {{ $treatment->doctor->name }}</dd>
      <dt class="col-sm-3">Status Pengobatan</dt>
      <dd class="col-sm-9 font-weight-bold text-info">: {{ $treatment->status }}</dd>
      <dt class="col-sm-3">Waktu Pengobatan</dt>
      <dd class="col-sm-9">: {{ $treatment->created_at->diffForHumans() }}</dd>
    </dl>
    @if( $treatment->status == 'menunggu antrian' )
    <a href="/patient/queue/{{ $treatment->id }}" class="btn btn-sm btn-primary">lihat antrian</a>
    @endif
  </div>
  
  @else
    <form action="/patient/treatments/{{ $treatment->id }}" method="post">
    @csrf
    @method('put')

    <div class="form-group">
      <label for="service_id">Pilih Layanan</label>
      <select name="service_id" id="service_id" class="form-control">
        @foreach ($services as $service)
            <option value="{{ $service->id }}" {{ $service->id == old('service_id', $treatment->service_id) ? 'selected' : '' }}>{{ $service->name }}</option>
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
      <textarea rows="5" name="complaint" id="complaint" class="form-control  @error('complaint') is-invalid @enderror" placeholder="Isi keluhan anda">{{ old('complaint', $treatment->complaint) }}</textarea>
      @error('complaint')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    
      <div class="form-group">
        <button type="submit" class="btn btn-success">Ubah</button>
      </div>
    </form>
  @endif
</div>
</div>


@endsection