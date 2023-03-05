@extends('doctor.main')

@section('content')

@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Antrian Hari Ini</h6>
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
            @foreach ($queues as $treatment)
              @if( $treatment->status == 'menunggu antrian' )
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
                    <a href="/doctor/treatments/{{ $treatment->id }}/edit" class="btn btn-sm btn-success">tangani</a>
                  </td>
              </tr>
              @endif
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