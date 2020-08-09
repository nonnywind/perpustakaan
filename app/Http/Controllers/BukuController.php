<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $title = 'List Buku';
        $data = \DB::table('m_buku')->get();

        return view('buku.buku_index', compact('title', 'data'));
    }
}
