<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //Get

    public function index() {
        $event = Event::all();
        return view('pages.event', ['event' => $event]);
    }
    // Store (Create)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $event = Event::create($validatedData);
        return response()->json($event, 201);
    }

    // Update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'string',
            'deskripsi' => 'string',
            'tanggal_mulai' => 'date',
            'tanggal_akhir' => 'date|after_or_equal:tanggal_mulai',
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