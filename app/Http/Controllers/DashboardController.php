<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Siswa;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Extrakurikuler;


class DashboardController extends Controller
{
    //
    public function index() {
        $extra= Extrakurikuler::count();
        $event = Event::count();
        $siswa = Siswa::count();
        $member = Member::count();
        return view('pages.dashboard', compact('extra', 'event', 'siswa' , 'member'));
    }

    public function data() {
    $extra = Extrakurikuler::count();
    $event = Event::count();
    $siswa = Siswa::count();
    $member = Member::count();

    return response()->json([
        'extra' => $extra,
        'event' => $event,
        'siswa' => $siswa,
        'member' => $member,
    ]);
}

public function getSiswa()
{
    // Get all extracurricular activities with their participants count
    $extrakurikulers = Extrakurikuler::withCount('siswas')->get();

    // Return the result
    return response()->json($extrakurikulers);
}
}