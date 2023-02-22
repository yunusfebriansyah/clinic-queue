<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdministratorDashboardController extends Controller
{
    
    public function index()
    {
        return view('admin.layouts.index', [
            'title' => 'Dashboard Administrator',
        ]);
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
            'username' => 'required|max:255'
        ];

        if( $request->username != auth()->user()->username ) :
            $rules['username'] = 'required|max:255|unique:users,username';
        endif;

        $validated = $request->validate($rules);
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
