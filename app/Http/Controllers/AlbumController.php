<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Album;
use App\Models\Galery;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return view for creating an album (if using blade template)
        // return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $album = Album::create($request->all());

        return redirect()->route('galery')->with('success', 'Album berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        return response()->json($album);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        // Return view for editing an album (if using blade template)
        // return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        try {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);


        $album->update($request->all());
        return redirect()->route('galery')->with('success', 'Album berhasil diupdate.');
    }catch (Exception $e) {

        return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat update data Album.']);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
        $album= Album::findOrFail($id);

        Galery::where('album_id', $id)->delete();

        $album->delete();
        return redirect()->route('galery')->with('success', 'Album berhasil dihapus.');
        }catch (Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data Album.']);
        }
    }
}