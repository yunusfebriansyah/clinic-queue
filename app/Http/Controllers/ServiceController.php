<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Treatment;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.layouts.services.index', [
            'notif_treatment' => count(Treatment::where('status', '!=', 'ditolak')->where('status', '!=', 'selesai')->where('status', '!=', 'dibatalkan')->get()),
            'title' => 'Data Layanan',
            'services' => Service::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.layouts.services.create',[
            'notif_treatment' => count(Treatment::where('status', '!=', 'ditolak')->where('status', '!=', 'selesai')->where('status', '!=', 'dibatalkan')->get()),
            'title' => 'Tambah Data Layanan'
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
        $rules = [
            'name' => 'required|max:255',
            'description' => 'required',
        ];
        if( !empty($request->is_lab) ) :
            $rules['is_lab'] = 'in:on';
        endif;
        $validated = $request->validate($rules);
        if( !empty($request->is_lab) ) :
            $validated['is_lab'] = true;
        else :
            $validated['is_lab'] = false;
        endif;
            
        Service::create($validated);
        return redirect('/administrator/services')->with('message', '<div class="alert alert-success mt-3" role="alert">Data layanan <strong>berhasil</strong> ditambah.</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('admin.layouts.services.show',[
            'notif_treatment' => count(Treatment::where('status', '!=', 'ditolak')->where('status', '!=', 'selesai')->where('status', '!=', 'dibatalkan')->get()),
            'title' => 'Detail Layanan ' . $service->name,
            'service' => $service
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('admin.layouts.services.edit',[
            'notif_treatment' => count(Treatment::where('status', '!=', 'ditolak')->where('status', '!=', 'selesai')->where('status', '!=', 'dibatalkan')->get()),
            'title' => 'Edit Layanan ' . $service->name,
            'service' => $service
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $rules = [
            'name' => 'required|max:255',
            'description' => 'required',
        ];
        if( !empty($request->is_lab) ) :
            $rules['is_lab'] = 'in:on';
        endif;
        $validated = $request->validate($rules);
        if( !empty($request->is_lab) ) :
            $validated['is_lab'] = true;
        else :
            $validated['is_lab'] = false;
        endif;
            
        Service::where('id', $service->id)->update($validated);
        return redirect('/administrator/services')->with('message', '<div class="alert alert-success mt-3" role="alert">Data layanan <strong>berhasil</strong> diubah.</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        Service::where('id', $service->id)->delete();
        return redirect('/administrator/services')->with('message', '<div class="alert alert-success mt-3" role="alert">Data layanan <strong>berhasil</strong> dihapus.</div>');
    }
}
