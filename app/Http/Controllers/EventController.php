<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Extrakurikuler;

class EventController extends Controller
{
    //Get

    public function index() {
        $extrakurikuler = Extrakurikuler::all();
        foreach ($extrakurikuler as $ek) {
            $ek->deskripsi = Str::limit($ek->deskripsi, 50);
        }
        $event = Event::all();
        return view('pages.event', ['event' => $event, 'extrakurikuler' => $extrakurikuler]);
    }
    // Store (Create)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'jadwal' => 'required|date',
            'id_extrakurikuler' => 'required',

        ]);

        try {
            $event = Event::create($validatedData);
            return redirect()->route('event')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data.']);
        }
    }

    // Update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'string',
            'deskripsi' => 'string',
            'jadwal' => 'date',

        ]);

        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $event->update($validatedData);
        return response()->json($event, 200);
    }

    // Delete
    public function destroy($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }
        $event->delete();
        return response()->json(['message' => 'Event deleted successfully'], 200);
    }
}