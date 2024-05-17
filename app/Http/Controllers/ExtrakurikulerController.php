<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Extrakurikuler;


class ExtrakurikulerController extends Controller
{
    public function index () {
        $extrakurikuler = Extrakurikuler::all();
        foreach ($extrakurikuler as $ek) {
            $ek->deskripsi = Str::limit($ek->deskripsi, 50);
        }
        return view('pages.extrakurikuler', ['extrakurikuler' => $extrakurikuler]);
    }

    public function store(Request $request) {
        $validate = $request->validate([
            'nama' => 'string|required',
            'deskripsi' => 'string|required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $path = $file->store('images', 'public'); // Simpan gambar di storage/app/public/images
            $validate['gambar'] = $path;
        };

        try {
            $extrakurikuler = Extrakurikuler::create($validate);
            return redirect()->route('extrakurikuler')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data.']);
        }
    }
}