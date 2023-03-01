<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Treatment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DoctorTreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('doctor.layouts.treatments.index', [
            'title' => 'Data Pengobatan',
            'today_treatments' => Treatment::with(['patient', 'disease', 'service'])->where('doctor_id', auth()->user()->id)->where('status', '!=', 'ditolak')->where('status', '!=', 'dibatalkan')->where('status', '!=', 'menunggu konfirmasi')->where('created_at', '>=', Carbon::today())->get(),
            'treatments' => Treatment::with(['patient', 'disease', 'service'])->where('doctor_id', auth()->user()->id)->where('status', '!=', 'ditolak')->where('status', '!=', 'dibatalkan')->where('status', '!=', 'menunggu konfirmasi')->orderBy('id', 'DESC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function show(Treatment $treatment)
    {
        return view('doctor.layouts.treatments.show', [
            'title' => 'Data Pengobatan : ' . $treatment->patient->name,
            'treatment' => $treatment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function edit(Treatment $treatment)
    {
        // if( $treatment->status != 'menunggu antrian' ) :
        //     return redirect('/doctor/queues')->with('message', '<div class="alert alert-danger mt-3" role="alert">Data pengobatan <strong>bukan menunggu antrian!</strong>.</div>');
        // endif;
        Treatment::where('id', $treatment->id)->update(['status' => 'ditangani']);
        return view('doctor.layouts.treatments.edit', [
            'title' => 'Penanganan Pengobatan : ' . $treatment->patient->name,
            'treatment' => Treatment::firstWhere('id', $treatment->id),
            'diseases' => Disease::all()
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
        $validated = $request->validate([
            'disease_id' => 'required|numeric|min:2|exists:diseases,id'
        ]);
        $validated['status'] = 'menunggu pembayaran';
        Treatment::where('id', $treatment->id)->update($validated);
        return redirect('/doctor/queues')->with('message', '<div class="alert alert-success mt-3" role="alert">Data pengobatan <strong>berhasil ditangani</strong>.</div>');
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
