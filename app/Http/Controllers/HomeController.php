<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Service;
use App\Models\Worker;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index()
    {
        return view('landing',[
            'universalServices' => Service::where('is_lab', false)->limit(5)->get(),
            'labServices' => Service::where('is_lab', true)->limit(3)->get(),
            'doctors' => Worker::where('role', 'doctor')->limit(2)->get(),
            'events' => Event::limit(3)->get()
        ]);
    }


}
