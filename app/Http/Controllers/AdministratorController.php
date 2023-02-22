<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.layouts.administrators.index', [
            'title' => 'Data Administrator',
            'administrators' => User::where('role', 'administrator')->where('id', '!=', 1)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.layouts.administrators.create', [
            'title' => 'Tambah Data Administrator'
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
            'username' => 'required|max:255|unique:users,username'
        ]);
        $validated['role'] = 'administrator';
        $validated['password'] = bcrypt($validated['username']);
        User::create($validated);
        return redirect('/administrator/users/administrators')->with('message', '<div class="alert alert-success mt-3" role="alert">Data administrator <strong>berhasil</strong> ditambah.</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $administrator
     * @return \Illuminate\Http\Response
     */
    public function show(User $administrator)
    {
        if ($administrator->role != 'administrator' or $administrator->id == 1) :
            return redirect('/administrator/users/administrators')->with('message', '<div class="alert alert-danger mt-3" role="alert">Data administrator <strong>tidak valid!</strong>.</div>');
        endif;
        return view('admin.layouts.administrators.show', [
            'title' => 'Detail Data Administrator : ' . $administrator->name,
            'administrator' => $administrator
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $administrator
     * @return \Illuminate\Http\Response
     */
    public function edit(User $administrator)
    {
        if ($administrator->role != 'administrator' or $administrator->id == 1) :
            return redirect('/administrator/users/administrators')->with('message', '<div class="alert alert-danger mt-3" role="alert">Data administrator <strong>tidak valid!</strong>.</div>');
        endif;
        if( $administrator->id == auth()->user()->id ) :
            return redirect('/administrator/users/administrators')->with('message', '<div class="alert alert-danger mt-3" role="alert">Data administrator <strong>tidak valid!</strong>.</div>');
        endif;
        return view('admin.layouts.administrators.edit', [
            'title' => 'Ubah Data Dokter : ' . $administrator->name,
            'administrator' => $administrator
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $administrator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $administrator)
    {
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|max:255'
        ];

        if( $request->username != $administrator->username ) :
            $rules['username'] = 'required|max:255|unique:users,username';
        endif;

        $validated = $request->validate($rules);
        $validated['role'] = 'administrator';
        $validated['password'] = bcrypt($validated['username']);
        User::where('id', $administrator->id)->update($validated);
        return redirect('/administrator/users/administrators')->with('message', '<div class="alert alert-success mt-3" role="alert">Data administrator <strong>berhasil</strong> diubah.</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $administrator
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $administrator)
    {
        if ($administrator->role != 'administrator' or $administrator->id == 1) :
            return redirect('/administrator/users/administrators')->with('message', '<div class="alert alert-danger mt-3" role="alert">Data administrator <strong>tidak valid!</strong>.</div>');
        endif;
        if( $administrator->id == auth()->user()->id ) :
            return redirect('/administrator/users/administrators')->with('message', '<div class="alert alert-danger mt-3" role="alert">Data administrator <strong>tidak valid!</strong>.</div>');
        endif;
        User::where('id', $administrator->id)->delete();
        return redirect('/administrator/users/administrators')->with('message', '<div class="alert alert-success mt-3" role="alert">Data administrator <strong>berhasil</strong> dihapus.</div>');
    }
}
