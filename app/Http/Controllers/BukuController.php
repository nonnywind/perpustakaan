<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $title = 'List Buku';
        $data = \DB::table('m_buku as b')->join('m_kategori as k', 'b.kategori', '=', 'k.id')->get();

        return view('buku.buku_index', compact('title', 'data'));
    }

    public function add()
    {
        $title = 'Tambah Buku';
        $kategori = \DB::table('m_kategori')->get();

        return view('buku.buku_add', compact('title', 'kategori'));
    }

    public function store(Request $request)
    {
        $judul = $request->judul;
        $keterangan = $request->keterangan;
        $stock = $request->stock;
        $kategori = $request->kategori;
        $penulis = $request->penulis;

        $file = $request->file('image');

        $destinationPath = 'uploads';
        $file->move($destinationPath, $file->getClientOriginalName());

        \DB::table('m_buku')->insert([
            'judul' => $judul,
            'keterangan' => $keterangan,
            'stock' => $stock,
            'kategori' => $kategori,
            'penulis' => $penulis,
            'gambar' => $file->getClientOriginalName(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('master/buku');
    }
}
