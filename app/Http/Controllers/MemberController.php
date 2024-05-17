<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function index() {
        $member = Member::all();
        return view('pages.member', ['member' => $member]);
    }


    public function store(Request $request)
{
    $request->validate([
        'id_siswa' => 'required|exists:siswas,id',
        'id_extrakurikuler' => 'required|exists:extrakurikulers,id',
    ]);

    Member::create($request->all());

    return redirect()->route('members.index')->with('success', 'Member berhasil ditambahkan.');
}

public function update(Request $request, Member $member)
{
    $request->validate([
        'id_siswa' => 'required|exists:siswas,id',
        'id_extrakurikuler' => 'required|exists:extrakurikulers,id',
    ]);

    $member->update($request->all());

    return redirect()->route('members.index')->with('success', 'Member berhasil diperbarui.');
}

public function destroy(Member $member)
{
    $member->delete();

    return redirect()->route('members.index')->with('success', 'Member berhasil dihapus.');
}

}