<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.layouts.diseases.index', [
            'title' => 'Data Keluhan',
            'diseases' => Disease::where('id', '!=', 1)->get()
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
        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);
        Disease::create($validated);
        return redirect('/administrator/diseases')->with('message', '<div class="alert alert-success" role="alert">Data keluhan <strong>berhasil</strong> ditambah.</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function show(Disease $disease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit(Disease $disease)
    {
        if( $disease->id == 1 ) :
            return redirect('/administrator/diseases')->with('message', '<div class="alert alert-danger" role="alert">Data keluhan <strong>tidak valid!</strong>.</div>');
        endif;
        
        return view('admin.layouts.diseases.edit', [
            'title' => 'Ubah Data Keluhan ' . $disease->name,
            'disease' => $disease
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disease $disease)
    {
        if( $disease->id == 1 ) :
            return redirect('/administrator/diseases')->with('message', '<div class="alert alert-danger" role="alert">Data keluhan <strong>tidak valid!</strong>.</div>');
        endif;

        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);
        Disease::where('id', $disease->id)->update($validated);
        return redirect('/administrator/diseases')->with('message', '<div class="alert alert-success" role="alert">Data keluhan <strong>berhasil</strong> diubah.</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disease $disease)
    {

        if( $disease->id == 1 ) :
            return redirect('/administrator/diseases')->with('message', '<div class="alert alert-danger" role="alert">Data keluhan <strong>tidak valid!</strong>.</div>');
        endif;

        Disease::where('id', $disease->id)->delete();
        return redirect('/administrator/diseases')->with('message', '<div class="alert alert-success" role="alert">Data keluhan <strong>berhasil</strong> diubah.</div>');
    }
}
