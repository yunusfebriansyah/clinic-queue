<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Service;
use App\Models\Treatment;
use Illuminate\Http\Request;

class PatientTreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('patient.layouts.treatments.index', [
            'title' => 'Data Berobat Anda',
            'treatments' => Treatment::with(['doctor', 'disease', 'service'])->where('patient_id', auth()->user()->id)->orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('patient.layouts.treatments.create', [
            'title' => 'Pendaftaran Berobat',
            'is_open' => Queue::first()->is_open,
            'services' => Service::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'complaint' => 'required'
        ]);

        $validated['patient_id'] = auth()->user()->id;

        Treatment::create($validated);
        return redirect('/patient/treatments')->with('message', '<div class="alert alert-success mt-3" role="alert">Pendaftaran <strong>berhasil</strong> dilakukan.</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function show(Treatment $treatment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function edit(Treatment $treatment)
    {
        if( $treatment->patient_id != auth()->user()->id ) :
            return redirect('/patient/treatments')->with('message', '<div class="alert alert-danger mt-3" role="alert">Pendaftaran <strong>tidak valid!</strong>.</div>');
        endif;

        return view('patient.layouts.treatments.edit', [
            'title' => 'Ubah Data Pendaftaran Berobat',
            'treatment' => $treatment,
            'services' => Service::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Treatment $treatment)
    {
        if( $treatment->patient_id != auth()->user()->id ) :
            return redirect('/patient/treatments')->with('message', '<div class="alert alert-danger mt-3" role="alert">Pendaftaran <strong>tidak valid!</strong>.</div>');
        endif;

        if( $treatment->status == 'menunggu antrian' ) :
            return redirect('/patient/treatments')->with('message', '<div class="alert alert-danger mt-3" role="alert">Pendaftaran <strong>sudah diverifikas </strong> admin.</div>');
        endif;

        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'complaint' => 'required'
        ]);

        $validated['patient_id'] = auth()->user()->id;

        Treatment::where('id', $treatment->id)->where('patient_id', auth()->user()->id)->update($validated);
        return redirect('/patient/treatments')->with('message', '<div class="alert alert-success mt-3" role="alert">Data pendaftaran <strong>berhasil</strong> diubah.</div>');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Treatment $treatment)
    {
        //
    }
}
