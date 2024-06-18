<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\User;
use App\Models\Posts;
use App\Models\Siswa;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Extrakurikuler;


class DashboardController extends Controller
{
    //
    public function index() {
        $extra= Extrakurikuler::count();
        $posts = Posts::count();
        $siswa = Siswa::count();
        $member = Member::count();
        return view('pages.dashboard', compact('extra', 'posts', 'siswa' , 'member'));
    }

    public function data() {
    $extra = Extrakurikuler::count();
    $posts = Posts::count();
    $siswa = Siswa::count();
    $member = Member::count();

    return response()->json([
        'extra' => $extra,
        'posts' => $posts,
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

public function generateReportPDF()
{
    // Ambil data yang dibutuhkan
    $extra = Extrakurikuler::count();
    $posts = Posts::count();
    $siswa = Siswa::count();
    $member = Member::count();

    // Load view untuk PDF
    $pdf = new Dompdf();
    $pdf->loadHtml(view('util.pdf', compact('extra', 'posts', 'siswa', 'member')));

    // (Optional) Setup ukuran kertas dan orientasid
    $pdf->setPaper('A4', 'portrait');

    // Render HTML menjadi PDF
    $pdf->render();

    // Outputkan PDF yang dihasilkan (inline view atau download)
    return $pdf->stream('report.pdf');
}
}
