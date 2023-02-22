@extends('admin.main')

@section('content')

<a href="/administrator/users/doctors/create" class="btn btn-success">Tambah Data Dokter</a>
@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Dokter</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
          <thead>
              <tr>
                  <th class="text-center">*</th>
                  <th>Nama</th>
                  <th>Spesialis</th>
                  <th>Jam Kerja</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($doctors as $doctor)
                <tr>
                    <td class="text-center">
                      <img src="{{ url('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}" class="rounded" height="80">
                    </td>
                    <td class="align-middle">{{ $doctor->name }}</td>
                    <td class="align-middle">{{ $doctor->specialist }}</td>
                    <td class="align-middle">{{ $doctor->practice_time }}</td>
                    <td class="align-middle">
                        <a href="/administrator/users/doctors/{{ $doctor->id }}/edit" class="btn btn-sm btn-success">ubah</a>
                        <a href="/administrator/users/doctors/{{ $doctor->id }}" class="btn btn-sm btn-primary">detail</a>
                        <form action="/administrator/users/doctors/{{ $doctor->id }}" class="d-inline" method="post">
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