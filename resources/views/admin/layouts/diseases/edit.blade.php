@extends('admin.main')

@section('content')

@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-4 mt-3">
  <div class="card-body">
    <form action="/administrator/diseases/{{ $disease->id }}" method="post">
      @csrf
      @method('put')
      <label for="name">Tambah Data Keluhan</label>
      <div class="input-group mb-3">
        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $disease->name) }}" placeholder="Nama keluhan" name="name" aria-describedby="submit" required>
        <div class="input-group-append">
          <button class="btn btn-success" type="submit" id="submit">Ubah</button>
        </div>
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    </form>
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