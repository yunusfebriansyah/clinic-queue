<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    public function index()
    {
        return view('landing',[
            'universalServices' => Service::where('is_lab', false)->get(),
            'labServices' => Service::where('is_lab', true)->get(),
            'doctors' => User::where('role', 'doctor')->get(),
            'events' => Event::all()
        ]);
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function actionLogin( Request $request )
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect($credentials['role']);
        }

        return back()->with('message', 'Login failed');
    }

    public function actionRegister( Request $request )
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username',
            'address' => 'required',
            'password' => 'required|min:8|max:255',
            'confirm_password' => 'same:password'
        ]);

        unset($validated['confirm_password']);

        $validated['role'] = 'patient';
        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);
        return redirect('/login')->with('success', '<div class="alert alert-success mt-3" role="alert">Data akun <strong>berhasil dibuat</strong>. Silakan login.</div>');

        
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }


}
