<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Galery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Extrakurikuler;

class LandingPageController extends Controller
{
    //
    public function index() {
        $galery = Galery::all();
        $posts = Posts::all();
        $extrakurikuler = Extrakurikuler::all();
        foreach ($extrakurikuler as $ek) {
            $ek->deskripsi = Str::limit($ek->deskripsi, 50);
        }
        return view('index', [
            'extrakurikuler' => $extrakurikuler,
            'posts' => $posts,
            'galery' => $galery
        ]);


    }
}