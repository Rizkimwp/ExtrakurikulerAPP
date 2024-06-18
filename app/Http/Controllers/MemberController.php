<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Extrakurikuler;

class MemberController extends Controller
{

    public function index(Request $request)
{
    // Ambil semua siswa
    $siswa = Siswa::all();

    // Ambil ID siswa yang sudah terdaftar
    $registeredIds = Member::pluck('id_siswa')->all();

    $unregisteredSiswa = $siswa->filter(function ($siswa) use ($registeredIds) {
        // Hitung berapa banyak extrakurikuler yang sudah didaftarkan siswa ini
        $registeredCount = Member::where('id_siswa', $siswa->id)->count();

        // Filter siswa yang belum mencapai batas maksimal (3 kali)
        return $registeredCount < 3 || !in_array($siswa->id, $registeredIds);
    });


    // Ambil semua extrakurikuler
    $extrakurikuler = Extrakurikuler::all();

    // Ambil input pencarian
    $search = $request->input('search');

    // Jika ada pencarian
    if ($search) {
        // Cari siswa yang sudah terdaftar pada extrakurikuler tertentu
        $registeredSiswa = Siswa::whereHas('extrakurikulers', function ($query) use ($search) {
            $query->where('extrakurikulers.id', $search);
        })->whereIn('id', $registeredIds)->get();

        // Cari siswa yang belum terdaftar pada extrakurikuler tertentu
        $unregisteredSiswa = Siswa::whereHas('extrakurikulers', function ($query) use ($search) {
            $query->where('extrakurikulers.id', $search);
        })->whereNotIn('id', $registeredIds)->get();
    } else {
        // Jika tidak ada pencarian, ambil semua siswa yang sudah terdaftar pada extrakurikuler
        $registeredSiswa = Siswa::with('extrakurikulers')->whereIn('id', $registeredIds)->get();
    }



    return view('pages.member', [
        'siswa' => $unregisteredSiswa,
        'extra' => $extrakurikuler,
        'update' => $extrakurikuler,
        'member' => $registeredSiswa
    ]);
}






    public function store(Request $request)
        {
    $validate = $request->validate([
        'id_siswa' => 'required',
        'id_extrakurikuler' => 'required',
    ]);

    try {

        $member = Member::create($validate);
        return redirect()->route('member')->with('success', 'Member berhasil ditambahkan.');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data member.']);
    }
        }

public function update(Request $request, $id)
{
   $validate =  $request->validate([
        'id_extrakurikuler' => 'required|exists:extrakurikulers,id',
    ]);

    try{

        $member = Member::where('id_siswa', $id)->firstOrFail();
        $member->update($validate);

        return redirect()->route('member')->with('success', 'Member berhasil diperbarui.');
    } catch (\Execption $e)
    {
        return redirect()->back()->withErrors(['error' => 'Terjadi Kesalahan Saat Update Data']);
    };

}

public function delete($id)
{
    try
    {
        $member = Member::where('id_siswa', $id)->firstOrFail();

        $member->delete();
        return redirect()->route('member')->with('success', 'Member berhasil dihapus.');
    }
    catch (\Exeption $e)
    {
        return redirect()->back()->withErrors(['error' => 'Terjadi Kesalahan Saat Menghapus Data Member']);
    }

}

}