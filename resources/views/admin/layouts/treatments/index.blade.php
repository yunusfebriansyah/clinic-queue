@extends('admin.main')

@section('content')

@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Pengobatan Menunggu Konfirmasi</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
          <thead>
              <tr>
                <th class="text-center">*</th>
                <th>Nama Pasien</th>
                <th>Dokter</th>
                <th>Layanan</th>
                <th>Penyakit</th>
                <th>Waktu Daftar</th>
                <th>Status Berobat</th>
                <th class="text-right">Aksi</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($is_pending_treatments as $treatment)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $treatment->patient->name }}</td>
                    <td>{{ $treatment->doctor->name }}</td>
                    <td>{{ $treatment->service->name }}</td>
                    <td>{{ $treatment->disease->name }}</td>
                    <td>{{ $treatment->created_at->diffForHumans() }}</td>
                    <td>{{ $treatment->status }}</td>
                    <td class="text-right">
                      <a href="/administrator/treatments/{{ $treatment->id }}/edit" class="btn btn-sm btn-success">detail & ubah</a>
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
    <h6 class="m-0 font-weight-bold text-primary">Data Pengobatan Menunggu Pembayaran</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered w-100" id="dataTable2" cellspacing="0">
          <thead>
              <tr>
                <th class="text-center">*</th>
                <th>Nama Pasien</th>
                <th>Dokter</th>
                <th>Layanan</th>
                <th>Penyakit</th>
                <th>Waktu Daftar</th>
                <th>Status Berobat</th>
                <th class="text-right">Aksi</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($is_payment_treatments as $treatment)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $treatment->patient->name }}</td>
                    <td>{{ $treatment->doctor->name }}</td>
                    <td>{{ $treatment->service->name }}</td>
                    <td>{{ $treatment->disease->name }}</td>
                    <td>{{ $treatment->created_at->diffForHumans() }}</td>
                    <td>{{ $treatment->status }}</td>
                    <td class="text-right">
                      <a href="/administrator/treatments/{{ $treatment->id }}/edit" class="btn btn-sm btn-success">detail & ubah</a>
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
      <table class="table table-bordered w-100" id="dataTable1" cellspacing="0">
          <thead>
              <tr>
                  <th class="text-center">*</th>
                  <th>Nama Pasien</th>
                  <th>Dokter</th>
                  <th>Layanan</th>
                  <th>Penyakit</th>
                  <th>Waktu Daftar</th>
                  <th>Status Berobat</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($treatments as $treatment)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $treatment->patient->name }}</td>
                    <td>{{ $treatment->doctor->name }}</td>
                    <td>{{ $treatment->service->name }}</td>
                    <td>{{ $treatment->disease->name }}</td>
                    <td>{{ $treatment->created_at->diffForHumans() }}</td>
                    <td>{{ $treatment->status }}</td>
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