@extends('admin.main')

@section('content')

<a href="/administrator/services/create" class="btn btn-success">Tambah Layanan</a>
@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Layanan</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
          <thead>
              <tr>
                  <th class="text-center">*</th>
                  <th>Nama</th>
                  <th class="text-center">Laboratorium</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $service->name }}</td>
                    <td class="text-center">
                        @if ( $service->is_lab )
                        <i class="fas fa-check-circle text-success"></i>
                        @else
                        <i class="fas fa-times-circle text-danger"></i>
                        @endif
                    </td>
                    <td>{{ substr($service->name, 0, 30) . '...' }}</td>
                    <td>
                        <a href="/administrator/services/{{ $service->id }}/edit" class="btn btn-sm btn-success">ubah</a>
                        <a href="/administrator/services/{{ $service->id }}" class="btn btn-sm btn-primary">detail</a>
                        <form action="/administrator/services/{{ $service->id }}" class="d-inline" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger">hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbodyw>
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