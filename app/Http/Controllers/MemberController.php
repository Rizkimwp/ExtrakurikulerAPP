<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Extrakurikuler;

class MemberController extends Controller
{

    public function index(Request $request) {
        $siswa = Siswa::all();
        $registered = Member::pluck('id_siswa')->all();
        $unregisteredSiswa = $siswa->whereNotIn('id', $registered);
        $extrakurikuler = Extrakurikuler::all();

        // Ambil input pencarian
        $search = $request->input('search');

        if ($search) {
            // Cari siswa yang memiliki ekstrakurikuler dengan ID yang dicari
            $registeredSiswa = Siswa::whereHas('extrakurikulers', function ($query) use ($search) {
                $query->where('extrakurikulers.id', $search);
            })->whereIn('id', $registered)->get();

            $unregisteredSiswa = Siswa::whereHas('extrakurikulers', function ($query) use ($search) {
                $query->where('extrakurikulers.id', $search);
            })->whereNotIn('id', $registered)->get();
        } else {
            // Jika tidak ada pencarian, ambil semua siswa yang sudah terdaftar
            $registeredSiswa = Siswa::with('extrakurikulers')->whereIn('id', $registered)->get();
            $unregisteredSiswa = Siswa::whereNotIn('id', $registered)->get();
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