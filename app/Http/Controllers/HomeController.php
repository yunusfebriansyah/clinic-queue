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
            'universalServices' => Service::where('is_lab', false)->limit(5)->get(),
            'labServices' => Service::where('is_lab', true)->limit(3)->get(),
            'doctors' => User::where('role', 'doctor')->limit(2)->get(),
            'events' => Event::limit(3)->get()
        ]);
    }

    public function login()
    {
        return view('login');
    }

    public function actionLogin( Request $request )
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect(auth()->user()->role);
        }

        return back()->with('message', 'Login failed');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }


}
