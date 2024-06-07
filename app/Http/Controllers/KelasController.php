<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index() {
        $kelas = Kelas::all();
        return view('pages.kelas', compact('kelas'));
    }

    public function store(Request $request){
        $validate = $request->validate([
             'nama_kelas' => 'required',
        ]);


        try {
            $kelas = Kelas::create($validate);
            return redirect()->route('kelas')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data.']);
        }
    }

    public function destroy($id) {
        try
        {
            $kelas = Kelas::where('id', $id)->firstOrFail();

            $kelas->delete();
            return redirect()->route('kelas')->with('success', 'Member berhasil dihapus.');
        }
        catch (\Exeption $e)
        {
            return redirect()->back()->withErrors(['error' => 'Terjadi Kesalahan Saat Menghapus Data Member']);
        }

    }
}
