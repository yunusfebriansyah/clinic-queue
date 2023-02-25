@extends('patient.main')

@section('content')

@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Pengobatan Anda</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
          <thead>
              <tr>
                <th class="text-center">*</th>
                <th>Dokter</th>
                <th>Layanan</th>
                <th>Penyakit</th>
                <th>Waktu Daftar</th>
                <th>Status Berobat</th>
                <th class="text-right">Aksi</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($treatments as $treatment)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $treatment->doctor->name }}</td>
                    <td>{{ $treatment->service->name }}</td>
                    <td>{{ $treatment->disease->name }}</td>
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
                    <td class="text-right">
                      <a href="/patient/treatments/{{ $treatment->id }}/edit" class="btn btn-sm btn-success">detail{{ $treatment->status == 'menunggu konfirmasi' ? ' & ubah' : '' }}</a>
                      @if( $treatment->status == 'menunggu antrian' )
                      <a href="/patient/queue/{{ $treatment->id }}" class="btn btn-sm btn-primary">antrian</a>
                      @endif
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