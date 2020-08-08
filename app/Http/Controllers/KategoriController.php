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

    public function add()
    {
        $title = 'Tambah Kategori';

        return view('kategori.kategori_add', compact('title'));
    }

    public function store(Request $request)
    {
        $nama = $request->nama;

        \DB::table('m_kategori')->insert([
            'nama' => $nama,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect('master/kategori');
    }
}
