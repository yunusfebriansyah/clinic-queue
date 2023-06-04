<div class="row gy-3">
    @if( $queue )
    <div class="col-12 col-md-6">

        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Antrian : {{ $queue->name }}</h6>
            </div>
            <div class="card-body">
                
                @php
                    $treatments = $queue->doctor_treatments;
                    $isTreated = NULL;
                    $myTreatment = NULL;
                    $myNumber = NULL;
                @endphp
                @foreach ($treatments as $treatment)
                @if( $treatment->status == 'ditangani' )
                @php
                    $isTreated = $treatment;
                @endphp
                @endif
                @endforeach
                @foreach ($treatments as $treatment)
                @if( $treatment->id == $my_queue->id and $treatment->patient_id == auth()->user()->id)
                @php
                    $myTreatment = $treatment;
                    $myNumber = $loop->iteration;
                @endphp
                @break
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
                @break
                @endif
                @endforeach

                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center"><i class="fas fa-arrow-up"></i></th>
                                <th class="text-center">No Antrian</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($treatments as $treatment)
                            @if( $treatment->status == 'menunggu antrian' )
                            <tr class="{{ $treatment == $myTreatment ? 'bg-info' : '' }}">
                                <td class="text-center">
                                    <img src="{{ url('storage/' . $treatment->patient->photo) }}" alt="{{ $treatment->patient->name }}" class="rounded" height="80">
                                </td>
                                <td class="text-center align-middle h4 font-weight-bold">{{ $loop->iteration }}</td>
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
    <div class="col-12 col-md-6">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pengobatan Saya</h6>
            </div>
            <div class="card-body">
                <p class="h3 font-weight-bold text-primary">No. {{ $myNumber }}</p>
                <dl class="row">
                    <dt class="col-sm-3">Keluhan</dt>
                    <dd class="col-sm-9">: {{ $myTreatment->complaint }}</dd>
                    <dt class="col-sm-3">Layanan</dt>
                    <dd class="col-sm-9">: {{ $myTreatment->service->name }}</dd>
                    <dt class="col-sm-3">Penyakit</dt>
                    <dd class="col-sm-9">: {{ $myTreatment->disease }}</dd>
                    <dt class="col-sm-3">Nama Dokter</dt>
                    <dd class="col-sm-9">: {{ $myTreatment->doctor->name }}</dd>
                    <dt class="col-sm-3">Status Pengobatan</dt>
                    <dd class="col-sm-9 font-weight-bold text-info">: {{ $myTreatment->status }}</dd>
                    <dt class="col-sm-3">Waktu Pengobatan</dt>
                    <dd class="col-sm-9">: {{ $myTreatment->created_at->diffForHumans() }}</dd>
                  </dl>
            </div>
        </div>
    </div>
    @else
    <div class="col-12">
        <p>tidak ada data antrian saat ini</p>
    </div>
    @endif
</div>