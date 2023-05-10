<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isPendingTreatments = Treatment::with(['doctor', 'patient', 'service'])->date(request('date'))->where('status', 'menunggu konfirmasi')->where('created_at', '>=', Carbon::today())->get();
        $isPaymentTreatments = Treatment::with(['doctor', 'patient', 'service'])->date(request('date'))->where('status', 'menunggu pembayaran')->where('created_at', '>=', Carbon::today())->get();
        $treatments = Treatment::with(['doctor', 'patient', 'service'])->date(request('date'))->orderBy('id', 'DESC')->get();
        return view('admin.layouts.treatments.index', [
            'title' => 'Data Pengobatan',
            'is_pending_treatments' => $isPendingTreatments,
            'is_payment_treatments' => $isPaymentTreatments,
            'treatments' => $treatments,
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function edit(Treatment $treatment)
    {
        return view('admin.layouts.treatments.edit', [
            'title' => 'Data Pengobatan : ' . $treatment->patient->name,
            'treatment' => $treatment,
            'doctors' => User::where('role', 'doctor')->get()
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
        $rules = [
            'status' => 'required',
        ];

        if( $treatment->status == 'menunggu konfirmasi' ) :
            $rules['status'] = 'required|in:ditolak,menunggu antrian';
        endif;
        if( $treatment->status == 'menunggu pembayaran' ) :
            $rules['status'] = 'required|in:selesai';
        endif;

        if( !empty($request->doctor_id) ) :
            $doctors = User::where('role', 'doctor')->get();
            $validDoctors = '';
            foreach ( $doctors as $doctor ):
                $validDoctors .= $doctor->id . ',';
            endforeach;
            $rules['doctor_id'] = 'required|in:' . $validDoctors;
        endif;
        
        $validated = $request->validate($rules);

        Treatment::where('id', $treatment->id)->update($validated);
        return redirect('/administrator/treatments')->with('message', '<div class="alert alert-success" role="alert">Pengobatan <strong>berhasil</strong> diubah ke <strong>' . $validated['status'] . '</strong>.</div>');
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

    public function print()
    {
        $treatments = Treatment::with(['doctor', 'patient', 'service'])->date(request('date'))->orderBy('id', 'DESC')->get();
        $title = 'Data Pengobatan';
        $date = 'Semua Waktu';
        if( !empty(request('date')) ) :
            if( request('date') == 'bulan ini' ) :
                $date = Carbon::now()->isoFormat('MMMM Y');
            elseif( request('date') == 'tahun ini' ) :
                $date =  Carbon::now()->isoFormat('Y');
            elseif( request('date') == 'hari ini' ) :
                $date =  Carbon::now()->isoFormat('D MMMM Y');
            elseif( request('date') == 'minggu ini' ) :
                $date =  Carbon::now()->startOfWeek()->isoFormat('D MMMM Y') . ' - ' . Carbon::now()->endOfWeek()->isoFormat('D MMMM Y');
            endif;
        endif;
        return view('admin.layouts.treatments.print', [
            'title' => $title,
            'treatments' => $treatments,
            'date' => $date
        ]);
    }

}
