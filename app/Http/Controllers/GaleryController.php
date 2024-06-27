<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Galery;
use Illuminate\Http\Request;
use App\Models\Extrakurikuler;
use Illuminate\Support\Facades\Storage;

class GaleryController extends Controller
{
    public function index() {
        $galery = Galery::all();
        $albums = Album::all();
        return view('pages.galery', compact('galery', 'albums'));
    }


    public function store(Request $request) {
        $validate = $request->validate([
            'nama' => 'required|string',
            'album_id' => 'required|string',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

     if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $path = $file->store('images', 'public'); // Simpan gambar di storage/app/public/images
            $validate['gambar'] = $path;
        };

        try {
            $galery = Galery::create($validate);
            return redirect()->route('galery')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data.']);
        }
    }


    public function update(Request $request, $id) {
        $validate = $request->validate([
            'nama' => 'required|string',
            'album_id' => 'required|string',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $galery = Galery::findOrFail($id);

        if ($request->hasFile('gambar')) {
            // Delete the old image if it exists
            if ($galery->gambar) {
                Storage::disk('public')->delete($galery->gambar);
            }

            // Store the new image
            $file = $request->file('gambar');
            $path = $file->store('images', 'public');
            $validate['gambar'] = $path;
        }

        try {
            $galery->update($validate);
            return redirect()->route('galery')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data.']);
        }
    }

    public function destroy($id) {
        $galery = Galery::findOrFail($id);

        try {
            // Delete the image file if it exists
            if ($galery->gambar) {
                Storage::disk('public')->delete($galery->gambar);
            }

            $galery->delete();
            return redirect()->route('galery')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data.']);
        }
    }


}