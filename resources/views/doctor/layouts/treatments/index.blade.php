@extends('doctor.main')

@section('content')

@if( session('message') )
  {!! session('message') !!}
@endif

<div class="row justify-content-end">
  <div class="col-12 col-md-6 col-xl-4">
    <form action="/doctor/treatments" method="get">
      <div class="input-group mb-3">
        <select name="date" class="form-control">
          <option value="">Semua</option>
          <option value="hari ini" {{ request('date') == 'hari ini' ? 'selected' : '' }}>Hari ini</option>
          <option value="minggu ini" {{ request('date') == 'minggu ini' ? 'selected' : '' }}>Minggu ini</option>
          <option value="bulan ini" {{ request('date') == 'bulan ini' ? 'selected' : '' }}>Bulan ini</option>
          <option value="tahun ini" {{ request('date') == 'tahun ini' ? 'selected' : '' }}>Tahun ini</option>
        </select>
        <div class="input-group-append">
          <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="row justify-content-end mb-3">
  <div class="col-12">
    <a target="_blank" href="/doctor/treatments/print?date={{ request('date') }}" class="btn btn-danger float-right"><i class="fas fa-print"></i> Cetak PDF</a>
  </div>
</div>

<div class="card shadow mb-4 mt-3">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Pengobatan Hari Ini</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
          <thead>
              <tr>
                <th class="text-center">*</th>
                <th>Nama Pasien</th>
                <th>Layanan</th>
                <th>Penyakit</th>
                <th>Waktu Daftar</th>
                <th>Status Berobat</th>
                <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($today_treatments as $treatment)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $treatment->patient->name }}</td>
                    <td>{{ $treatment->service->name }}</td>
                    <td>{{ $treatment->disease }}</td>
                    <td>{{ $treatment->created_at->diffForHumans() }}</td>
                    <td>
                      @if ( $treatment->status == 'selesai' )
                      <span class="bg-success text-white px-2 rounded">{{ $treatment->status }}</span>
                      @elseif ( $treatment->status == 'ditolak' or $treatment->status == 'dibatalkan' )
                      <span class="bg-danger text-white px-2 rounded">{{ $treatment->status }}</span>
                      @elseif ( $treatment->status == 'menunggu antrian' )
                      <span class="bg-primary text-white px-2 rounded">{{ $treatment->status }}</span>
                      @else
                      <span class="bg-warning text-white px-2 rounded">{{ $treatment->status }}</span>
                      @endif
                    </td>
                    <td>
                      <a href="/doctor/treatments/{{ $treatment->id }}" class="btn btn-sm btn-success">detail</a>
                    </td>
                </tr>
            @endforeach
          </tbody>
      </table>
    </div>
  </div>
</div>
<div class="card shadow mb-4 mt-3">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Semua Pengobatan</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
          <thead>
              <tr>
                <th class="text-center">*</th>
                <th>Nama Pasien</th>
                <th>Layanan</th>
                <th>Penyakit</th>
                <th>Waktu Daftar</th>
                <th>Status Berobat</th>
                <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($treatments as $treatment)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $treatment->patient->name }}</td>
                    <td>{{ $treatment->service->name }}</td>
                    <td>{{ $treatment->disease }}</td>
                    <td>{{ $treatment->created_at->diffForHumans() }}</td>
                    <td>
                      @if ( $treatment->status == 'selesai' )
                      <span class="bg-success text-white px-2 rounded">{{ $treatment->status }}</span>
                      @elseif ( $treatment->status == 'ditolak' or $treatment->status == 'dibatalkan' )
                      <span class="bg-danger text-white px-2 rounded">{{ $treatment->status }}</span>
                      @elseif ( $treatment->status == 'menunggu antrian' )
                      <span class="bg-primary text-white px-2 rounded">{{ $treatment->status }}</span>
                      @else
                      <span class="bg-warning text-white px-2 rounded">{{ $treatment->status }}</span>
                      @endif
                    </td>
                    <td>
                      <a href="/doctor/treatments/{{ $treatment->id }}" class="btn btn-sm btn-success">detail</a>
                    </td>
                </tr>
            @endforeach
          </tbody>
      </table>
    </div>
  </div>
</div>



@endsection

@section('script')
  <!-- Page level plugins -->
  <script src="/admin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="/admin/js/demo/datatables-demo.js"></script>
@endsection