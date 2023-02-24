@extends('patient.main')

@section('content')

{{-- top card --}}
@if( session('message') )
  {!! session('message') !!}
@endif

<div class="row">

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Selesai Ditangani</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- end top card --}}




@endsection