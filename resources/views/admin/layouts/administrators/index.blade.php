@extends('admin.main')

@section('content')

<a href="/administrator/users/administrators/create" class="btn btn-success">Tambah Data Administrator</a>
@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Administrator</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
          <thead>
              <tr>
                  <th class="text-center">*</th>
                  <th>Nama</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($administrators as $administrator)
                <tr>
                    <td class="text-center">
                      <img src="{{ url('storage/' . $administrator->photo) }}" alt="{{ $administrator->name }}" class="rounded" height="80">
                    </td>
                    <td class="align-middle">{{ $administrator->name }}</td>
                    <td class="align-middle">
                        @if ($administrator->id != auth()->user()->id)
                        <a href="/administrator/users/administrators/{{ $administrator->id }}/edit" class="btn btn-sm btn-success">ubah</a>
                        <a href="/administrator/users/administrators/{{ $administrator->id }}" class="btn btn-sm btn-primary">detail</a>
                        <form action="/administrator/users/administrators/{{ $administrator->id }}" class="d-inline" method="post">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-sm btn-danger">hapus</button>
                        </form>
                        @else
                        <p class="text-danger font-weight-bold">diri anda</p>
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