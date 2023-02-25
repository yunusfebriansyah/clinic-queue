<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PatientDashboardController extends Controller
{
    
    public function index()
    {
        return view('patient.layouts.index', [
            'title' => 'Dashboard Pasien'
        ]);
    }

    public function queue(Treatment $treatment)
    {
        return view('patient.layouts.queue', [
            'title' => 'Data Antrian ' . $treatment->doctor->name,
            'queue' => User::with(['doctor_treatments'])->where('role', 'doctor')->where('id', $treatment->doctor_id)->today()->first(),
            'my_queue' => $treatment
        ]);
    }

    public function loadQueue(Treatment $treatment)
    {
        return view('patient.layouts.load-queue', [
            'queue' => User::with(['doctor_treatments'])->where('role', 'doctor')->where('id', $treatment->doctor_id)->today()->first(),
            'my_queue' => $treatment
        ]);
    }

    public function editProfile()
    {
        return view('patient.layouts.edit-profile', [
            'title' => 'Ubah Profil',
            'user' => User::firstWhere('id', auth()->user()->id)
        ]);
    }

    public function updateProfile(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'address' => 'required',
            'photo' => 'image|file|max:1500'
        ];

        if( $request->username != auth()->user()->username ) :
            $rules['username'] = 'required|max:255|unique:users,username';
        endif;

        $validated = $request->validate($rules);

        if( $request->file('photo') != null ) :
            if( auth()->user()->photo != 'photos/profiles/avatar.png' ) :
                Storage::delete(auth()->user()->photo);
            endif;
            $validated['photo'] = $request->file('photo')->store('photos/profiles');
        else :
            $validated['photo'] = auth()->user()->photo;
        endif;

        $validated['role'] = 'patient';
        User::where('id', auth()->user()->id)->update($validated);
        $request->session()->put('name', $validated['name']);
        $request->session()->put('username', $validated['username']);
        $request->session()->put('photo', $validated['photo']);
        return redirect('/patient/edit-profile')->with('message', '<div class="alert alert-success mt-3" role="alert">Data akun <strong>berhasil</strong> diubah.</div>');
    }

    public function editPassword()
    {
        return view('patient.layouts.edit-password', [
            'title' => 'Ubah Password',
            'user' => User::firstWhere('id', auth()->user()->id)
        ]);
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min:8|max:255',
            'confirm_password' => 'same:new_password'
        ];
        $validated = $request->validate($rules);

        $user = User::firstWhere('id', auth()->user()->id);

        if( !password_verify($validated['old_password'], $user->password) ) :
            return redirect('/patient/change-password')->with('message', '<div class="alert alert-danger mt-3" role="alert">Password lama <strong>salah!</strong>.</div>');
        endif;
        if( $validated['old_password'] === $validated['new_password'] ) :
            return redirect('/patient/change-password')->with('message', '<div class="alert alert-danger mt-3" role="alert">Password baru <strong>harus beda</strong> dengan password lama.</div>');
        endif;

        User::where('id', auth()->user()->id)->update([
            'password' => bcrypt($validated['new_password'])
        ]);
        return redirect('/patient/change-password')->with('message', '<div class="alert alert-success mt-3" role="alert">Password <strong>berhasil</strong> diubah.</div>');
    }


}
