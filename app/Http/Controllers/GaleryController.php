<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;
use App\Models\Extrakurikuler;

class GaleryController extends Controller
{
    public function index() {
        $galery = Galery::all();
        $extrakurikuler = Extrakurikuler::all();
        return view('pages.galery', compact('galery', 'extrakurikuler'));
    }

    public function store(Request $request) {
        $validate = $request->validate([
            'nama' => 'required|string',
            'id_extrakurikuler' => 'required|string',
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
}