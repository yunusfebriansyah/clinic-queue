@extends('patient.main')

@section('content')

{{-- top card --}}
@if( session('message') )
  {!! session('message') !!}
@endif

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Selesai Ditangani</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $is_done_treatments }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Menunggu Konfirmasi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $is_wait_treatments }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Menunggu Pembayaran</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $is_payment_treatments }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-spinner fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Dibatalkan & Ditolak</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $is_denied_treatments }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-times-circle fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- end top card --}}




@endsection