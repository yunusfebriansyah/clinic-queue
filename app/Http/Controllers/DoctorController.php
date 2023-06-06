<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.layouts.doctors.index', [
            'notif_treatment' => count(Treatment::where('status', '!=', 'ditolak')->where('status', '!=', 'selesai')->where('status', '!=', 'dibatalkan')->get()),
            'title' => 'Data Dokter',
            'doctors' => User::where('role', 'doctor')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.layouts.doctors.create', [
            'notif_treatment' => count(Treatment::where('status', '!=', 'ditolak')->where('status', '!=', 'selesai')->where('status', '!=', 'dibatalkan')->get()),
            'title' => 'Tambah Data Dokter'
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
            'specialist' => 'required|max:255',
            'practice_time' => 'required|max:255'
        ]);
        $validated['role'] = 'doctor';
        $validated['password'] = bcrypt($validated['username']);
        User::create($validated);
        return redirect('/administrator/users/doctors')->with('message', '<div class="alert alert-success mt-3" role="alert">Data dokter <strong>berhasil</strong> ditambah.</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(User $doctor)
    {
        if( $doctor->role != 'doctor' ) :
            return redirect('/administrator/users/doctors')->with('message', '<div class="alert alert-danger mt-3" role="alert">Data dokter <strong>tidak valid!</strong>.</div>');
        endif;
        return view('admin.layouts.doctors.show', [
            'notif_treatment' => count(Treatment::where('status', '!=', 'ditolak')->where('status', '!=', 'selesai')->where('status', '!=', 'dibatalkan')->get()),
            'title' => 'Detail Data Dokter : ' . $doctor->name,
            'doctor' => $doctor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(User $doctor)
    {
        if( $doctor->role != 'doctor' ) :
            return redirect('/administrator/users/doctors')->with('message', '<div class="alert alert-danger mt-3" role="alert">Data dokter <strong>tidak valid!</strong>.</div>');
        endif;
        return view('admin.layouts.doctors.edit', [
            'notif_treatment' => count(Treatment::where('status', '!=', 'ditolak')->where('status', '!=', 'selesai')->where('status', '!=', 'dibatalkan')->get()),
            'title' => 'Ubah Data Dokter : ' . $doctor->name,
            'doctor' => $doctor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $doctor)
    {
        if( $doctor->role != 'doctor' ) :
            return redirect('/administrator/users/doctors')->with('message', '<div class="alert alert-danger mt-3" role="alert">Data dokter <strong>tidak valid!</strong>.</div>');
        endif;

        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'specialist' => 'required|max:255',
            'practice_time' => 'required|max:255'
        ];

        if( $request->username != $doctor->username ) :
            $rules['username'] = 'required|max:255|unique:users,username';
        endif;

        $validated = $request->validate($rules);
        $validated['role'] = 'doctor';
        $validated['password'] = bcrypt($validated['username']);
        User::where('id', $doctor->id)->update($validated);
        return redirect('/administrator/users/doctors')->with('message', '<div class="alert alert-success mt-3" role="alert">Data dokter <strong>berhasil</strong> diubah.</div>');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $doctor)
    {
        if( $doctor->role != 'doctor' ) :
            return redirect('/administrator/users/doctors')->with('message', '<div class="alert alert-danger mt-3" role="alert">Data dokter <strong>tidak valid!</strong>.</div>');
        endif;
        User::where('id', $doctor->id)->delete();
        return redirect('/administrator/users/doctors')->with('message', '<div class="alert alert-success mt-3" role="alert">Data dokter <strong>berhasil</strong> dihapus.</div>');
    }
}
