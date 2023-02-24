@extends('admin.main')

@section('content')

{{-- top card --}}
@if( session('message') )
  {!! session('message') !!}
@endif

<div id="queue_admin">

    <div class="row">
        @if( count( $queue_by_doctors ) > 0 )
        @foreach( $queue_by_doctors as $queue)
        <div class="col-12 col-md-6">

            <div class="card shadow mb-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Antrian : {{ $queue->name }}</h6>
                </div>
                <div class="card-body">
                    
                    @php
                        $treatments = $queue->doctor_treatments;
                        $isTreated = NULL;
                    @endphp
                    @foreach ($treatments as $treatment)
                    @if( $treatment->status == 'ditangani' )
                    @php
                        $isTreated = $treatment;
                    @endphp
                    @endif
                    @endforeach
                    
                    @if( $isTreated != NULL )
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sedang Ditangani</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $isTreated->patient->name }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-2x fa-stethoscope text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endif

                    @foreach ($treatments as $treatment)
                    @if( $treatment->status == 'menunggu antrian' )
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Harap Bersiap-siap</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $treatment->patient->name }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-2x fa-arrow-up text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endif
                    @break
                    @endforeach

                    <div class="table-responsive">
                        <table class="table table-bordered w-100" id="dataTable{{ $loop->iteration }}" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-arrow-up"></i></th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($treatments as $treatment)
                                @if( $treatment->status == 'menunggu antrian' )
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ url('storage/' . $treatment->patient->photo) }}" alt="{{ $treatment->patient->name }}" class="rounded" height="80">
                                    </td>
                                    <td class="align-middle">{{ $treatment->patient->name }}</td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        @endforeach
        @else
        <div class="col-12">
            <p>tidak ada data antrian saat ini</p>
        </div>
        @endif
    </div>

</div>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/admin/js/demo/load-queue.js"></script>
@endsection