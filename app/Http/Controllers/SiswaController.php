<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    //
    public function index() {
        $kelas = Kelas::all();
        $siswa = Siswa::paginate(1);
        return view('pages.siswa', ['siswa'=>$siswa,
    'kelas' => $kelas]);
    }


    public function store(Request $request) {

        $validate = $request->validate( [
            'nama' => 'required|string',
            'alamat' => 'required',
            'nomor_hp' => 'required',
            'id_kelas' => 'required',
            'nama_wali' => 'required'
        ]);


        try {
            $siswa = Siswa::create($validate);
            return redirect()->route('siswa')->with('success', 'Data siswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data siswa.']);
        }


    }

    public function update(Request $request, $id) {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required',
            'nomor_hp' => 'required',
            'id_kelas' => 'required',
            'nama_wali' => 'required'
        ]);

        try {
            // Cari data siswa berdasarkan ID
            $siswa = Siswa::findOrFail($id);

            // Update data siswa
            $siswa->update($validatedData);

            return redirect()->route('siswa')->with('success', 'Data siswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data siswa.']);
        }
    }

    public function delete($id) {
        try {
            // Cari data siswa berdasarkan ID
            $siswa = Siswa::findOrFail($id);

            // Hapus data siswa
            $siswa->delete();

            return redirect()->route('siswa')->with('success', 'Data siswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data siswa.']);
        }
    }

}