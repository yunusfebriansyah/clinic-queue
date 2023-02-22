<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.layouts.events.index', [
            'title' => 'Data Galeri Kegiatan',
            'events' => Event::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.layouts.events.create', [
            'title' => 'Tambah Data Galeri Kegiatan'
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
            'description' => 'required',
            'photo' => 'required|image|file|max:1500'
        ]);

        $validated['photo'] =$request->file('photo')->store('photos/events');
        Event::create($validated);
        return redirect('/administrator/events')->with('message', '<div class="alert alert-success mt-3" role="alert">Data kegiatan <strong>berhasil</strong> ditambah.</div>');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('admin.layouts.events.show', [
            'title' => 'Detail Galeri Kegiatan : ' . $event->name,
            'event' => $event
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.layouts.events.edit', [
            'title' => 'Ubah Galeri Kegiatan : ' . $event->name,
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $rules = [
            'name' => 'required|max:255',
            'description' => 'required',
            'photo' => 'image|file|max:1500'
        ];

        $validated = $request->validate($rules);

        if( $request->file('photo') != null ) :
            Storage::delete($event->photo);
            $validated['photo'] = $request->file('photo')->store('photos/events');
        else :
            $validated['photo'] = $event->photo;
        endif;

        Event::where('id', $event->id)->update($validated);
        return redirect('/administrator/events')->with('message', '<div class="alert alert-success mt-3" role="alert">Data kegiatan <strong>berhasil</strong> diubah.</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        Event::where('id', $event->id)->delete();
        return redirect('/administrator/events')->with('message', '<div class="alert alert-success mt-3" role="alert">Data kegiatan <strong>berhasil</strong> dihapus.</div>');
    }
}
