<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $title = 'Master Kategori';
        $data = \DB::table('m_kategori')->get();

        return view('kategori.kategori_index', compact('title', 'data'));
    }
}
