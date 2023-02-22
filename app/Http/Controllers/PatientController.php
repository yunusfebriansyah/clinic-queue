<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.layouts.patients.index', [
            'title' => 'Data Pasien',
            'patients' => User::where('role', 'patient')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.layouts.patients.create', [
            'title' => 'Tambah Data Pasien'
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
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username',
            'address' => 'required'
        ]);
        $validated['role'] = 'patient';
        $validated['password'] = bcrypt($validated['username']);
        User::create($validated);
        return redirect('/administrator/users/patients')->with('message', '<div class="alert alert-success mt-3" role="alert">Data pasien <strong>berhasil</strong> ditambah.</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(User $patient)
    {
        if ($patient->role != 'patient') :
            return redirect('/administrator/users/patients')->with('message', '<div class="alert alert-danger mt-3" role="alert">Data pasien <strong>tidak valid!</strong>.</div>');
        endif;
        return view('admin.layouts.patients.show', [
            'title' => 'Detail Data Pasien : ' . $patient->name,
            'patient' => $patient
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(User $patient)
    {
        if ($patient->role != 'patient') :
            return redirect('/administrator/users/patients')->with('message', '<div class="alert alert-danger mt-3" role="alert">Data pasien <strong>tidak valid!</strong>.</div>');
        endif;
        return view('admin.layouts.patients.edit', [
            'title' => 'Ubah Data Pasien : ' . $patient->name,
            'patient' => $patient
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $patient)
    {
        if ($patient->role != 'patient') :
            return redirect('/administrator/users/patients')->with('message', '<div class="alert alert-danger mt-3" role="alert">Data pasien <strong>tidak valid!</strong>.</div>');
        endif;
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'address' => 'required'
        ];

        if( $request->username != $patient->username ) :
            $rules['username'] = 'required|max:255|unique:users,username';
        endif;

        $validated = $request->validate($rules);
        $validated['role'] = 'patient';
        $validated['password'] = bcrypt($validated['username']);
        User::where('id', $patient->id)->update($validated);
        return redirect('/administrator/users/patients')->with('message', '<div class="alert alert-success mt-3" role="alert">Data pasien <strong>berhasil</strong> diubah.</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $patient)
    {
        if ($patient->role != 'patient') :
            return redirect('/administrator/users/patients')->with('message', '<div class="alert alert-danger mt-3" role="alert">Data pasien <strong>tidak valid!</strong>.</div>');
        endif;
        User::where('id', $patient->id)->delete();
        return redirect('/administrator/users/patients')->with('message', '<div class="alert alert-success mt-3" role="alert">Data pasien <strong>berhasil</strong> dihapus.</div>');
    }
}
