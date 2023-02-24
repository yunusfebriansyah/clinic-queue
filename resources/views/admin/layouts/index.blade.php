@extends('admin.main')

@section('content')

{{-- top card --}}
@if( session('message') )
  {!! session('message') !!}
@endif

<div class="card shadow mb-3">
    <div class="card-body">
        <h3 class="h4 font-weight-bold text-dark">Ubah Status Antrian</h3>
        <p class="font-weight-bold">Saat ini status antrian pendaftar adalah : 
            @if ( $is_open )
            <span class="text-success">Dibuka</span>
            @else
            <span class="text-danger">Ditutup</span>
            @endif
        </p>
        <form action="/administrator" method="post">
            @csrf
            <div class="custom-control custom-switch mb-2">
                <input type="checkbox" class="custom-control-input  @error('is_open') is-invalid @enderror" name="is_open" id="is_open" {{ $is_open ? 'checked' : '' }}>
                <label class="custom-control-label" for="is_open">Buka Antrian?</label>
                @error('is_open')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Ubah</button>
        </form>
    </div>
</div>

<div class="row">

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Selesai Ditangani</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $is_success_treatment }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Menunggu Konfirmasi
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $is_pending_treatment }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Dibatalkan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $is_denied_treatment }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-ban fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
{{-- end top card --}}




@endsection