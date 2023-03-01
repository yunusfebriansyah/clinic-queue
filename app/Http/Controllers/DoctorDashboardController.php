<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DoctorDashboardController extends Controller
{
    
    public function index()
    {
        return view('doctor.layouts.index', [
            'title' => 'Dashboard Dokter',
            'is_done_treatments' => count(Treatment::where('doctor_id', auth()->user()->id)->where('status', 'selesai')->get()),
            'is_queue_treatments_today' => count(Treatment::where('doctor_id', auth()->user()->id)->where('status', '!=', 'ditolak')->where('status', '!=', 'dibatalkan')->where('status', '!=', 'menunggu konfirmasi')->where('created_at', '>=', Carbon::today())->get()),
            'is_queue_treatments' => count(Treatment::where('doctor_id', auth()->user()->id)->where('status', 'menunggu antrian')->where('created_at', '>=', Carbon::today())->get())
        ]);
    }


}
