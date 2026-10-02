<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        $ekskuls = Ekstrakurikuler::orderBy('id')->get();

        return view('ekstrakurikuler', compact('ekskuls'));
    }
}