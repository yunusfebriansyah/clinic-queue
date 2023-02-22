@extends('admin.main')

@section('content')

<a href="/administrator/users/patients/create" class="btn btn-success">Tambah Data Pasien</a>
@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Pasien</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
          <thead>
              <tr>
                  <th class="text-center">*</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td class="text-center">
                      <img src="{{ url('storage/' . $patient->photo) }}" alt="{{ $patient->name }}" class="rounded" height="80">
                    </td>
                    <td class="align-middle">{{ $patient->name }}</td>
                    <td class="align-middle">{{ $patient->address }}</td>
                    <td class="align-middle">
                        <a href="/administrator/users/patients/{{ $patient->id }}/edit" class="btn btn-sm btn-success">ubah</a>
                        <a href="/administrator/users/patients/{{ $patient->id }}" class="btn btn-sm btn-primary">detail</a>
                        <form action="/administrator/users/patients/{{ $patient->id }}" class="d-inline" method="post">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-sm btn-danger">hapus</button>
                        </form>
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