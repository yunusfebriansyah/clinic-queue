@extends('admin.main')

@section('content')

<form action="/administrator/diseases" method="post">
  @csrf
  <label for="name">Tambah Data Keluhan</label>
  <div class="input-group mb-3">
    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama keluhan" name="name" aria-describedby="submit" required>
    <div class="input-group-append">
      <button class="btn btn-success" type="submit" id="submit">Tambah</button>
    </div>
    @error('name')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
</form>

@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Keluhan</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
          <thead>
              <tr>
                  <th class="text-center">*</th>
                  <th>Nama</th>
                  <th class="text-right">Aksi</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($diseases as $disease)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $disease->name }}</td>
                    <td class="text-right">
                        <a href="/administrator/diseases/{{ $disease->id }}/edit" class="btn btn-sm btn-success">ubah</a>
                        <form action="/administrator/diseases/{{ $disease->id }}" class="d-inline" method="post">
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