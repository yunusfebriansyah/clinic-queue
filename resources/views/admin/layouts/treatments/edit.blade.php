@extends('admin.main')

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
          <dt class="col-sm-3">Keluhan Pasien</dt>
          <dd class="col-sm-9">: {{ $treatment->complaint }}</dd>
          <dt class="col-sm-3">Layanan</dt>
          <dd class="col-sm-9">: {{ $treatment->service->name }}</dd>
          <dt class="col-sm-3">Penyakit Pasien</dt>
          <dd class="col-sm-9">: {{ $treatment->disease }}</dd>
          <dt class="col-sm-3">Nama Dokter</dt>
          <dd class="col-sm-9">: {{ $treatment->doctor->name }}</dd>
          <dt class="col-sm-3">Status Pengobatan</dt>
          <dd class="col-sm-9 font-weight-bold text-info">: {{ $treatment->status }}</dd>
          <dt class="col-sm-3">Waktu Pengobatan</dt>
          <dd class="col-sm-9">: {{ $treatment->created_at->diffForHumans() }}</dd>
        </dl>
      </div>
    </div>
  </div>
  @if ( $treatment->status == 'menunggu konfirmasi' )
  <div class="card-body border-top">
    <form action="/administrator/treatments/{{ $treatment->id }}" method="post" class="border rounded p-2 mb-3">
    <h3 class="h4 font-weight-bold text-success">Konfirmasi Pengobatan</h3>
    @csrf
    @method('put')
    <input type="hidden" name="status" value="menunggu antrian">
    <div class="form-group">
      <label for="doctor_id">Pilih Dokter yang Menangani</label>
      <select class="form-control @error('doctor_id') is-invalid @enderror" id="doctor_id" name="doctor_id">
        @foreach ( $doctors as $doctor )
        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
        @endforeach
      </select>
      @error('doctor_id')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-success">Konfirmasi</button>
    </div>
    </form>

    <form action="/administrator/treatments/{{ $treatment->id }}" method="post" class="border rounded p-2">
      <h3 class="h4 font-weight-bold text-danger">Tolak Pengobatan</h3>
      @csrf
      @method('put')
      <input type="hidden" name="status" value="ditolak">
      <button type="submit" class="btn btn-danger">Tolak</button>
    </form>

  </div>
  @endif
  @if ( $treatment->status == 'menunggu pembayaran' )
  <div class="card-body border-top">
    <form action="/administrator/treatments/{{ $treatment->id }}" method="post" class="border rounded p-2">
      <h3 class="h4 font-weight-bold text-success">Konfirmasi Pembayaran</h3>
      @csrf
      @method('put')
      <input type="hidden" name="status" value="selesai">
      <button type="submit" class="btn btn-success">Konfirmasi</button>
    </form>
  </div>
  @endif
</div>



@endsection