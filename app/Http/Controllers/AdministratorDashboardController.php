<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Treatment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdministratorDashboardController extends Controller
{
    
    public function index()
    {
        return view('admin.layouts.index', [
            'title' => 'Dashboard Administrator',
            'is_open' => Queue::first()->is_open,
            'is_success_treatment' => count(Treatment::where('status', 'selesai')->get()),
            'is_pending_treatment' => count(Treatment::where('status', 'menunggu konfirmasi')->get()),
            'is_denied_treatment' => count(Treatment::where('status', 'dibatalkan')->get()),
        ]);
    }

    public function changeQueue(Request $request)
    {
        if( !empty($request->is_open) ) :
            $validated = $request->validate([
                'is_open' => 'in:on'
            ]);
        endif;
        if( !empty($request->is_open) ) :
            $validated['is_open'] = true;
            $message = 'dibuka';
        else :
            $validated['is_open'] = false;
            $message = 'ditutup';
        endif;
        Queue::where('id', 1)->update($validated);
        Treatment::where('status', '!=', 'selesai')->where('created_at', '<', Carbon::today())->update(['status' => 'ditolak']);
        return redirect('/administrator')->with('message', '<div class="alert alert-success mt-3" role="alert">Antrian <strong>berhasil ' . $message . '</strong>.</div>');
    }

    public function editProfile()
    {
        return view('admin.layouts.edit-profile', [
            'title' => 'Ubah Profil',
            'user' => User::firstWhere('id', auth()->user()->id)
        ]);
    }

    public function updateProfile(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
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

        $validated['role'] = 'administrator';
        User::where('id', auth()->user()->id)->update($validated);
        $request->session()->put('name', $validated['name']);
        $request->session()->put('username', $validated['username']);
        return redirect('/administrator/edit-profile')->with('message', '<div class="alert alert-success mt-3" role="alert">Data akun <strong>berhasil</strong> diubah.</div>');
    }

    public function editPassword()
    {
        return view('admin.layouts.edit-password', [
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
            return redirect('/administrator/change-password')->with('message', '<div class="alert alert-danger mt-3" role="alert">Password lama <strong>salah!</strong>.</div>');
        endif;
        if( $validated['old_password'] === $validated['new_password'] ) :
            return redirect('/administrator/change-password')->with('message', '<div class="alert alert-danger mt-3" role="alert">Password baru <strong>harus beda</strong> dengan password lama.</div>');
        endif;

        User::where('id', auth()->user()->id)->update([
            'password' => bcrypt($validated['new_password'])
        ]);
        return redirect('/administrator/change-password')->with('message', '<div class="alert alert-success mt-3" role="alert">Password <strong>berhasil</strong> diubah.</div>');
    }

}
