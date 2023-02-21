<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministratorDashboardController extends Controller
{
    
    public function index()
    {
        return view('admin.layouts.index', [
            'title' => 'Dashboard Administrator',
        ]);
    }

}
