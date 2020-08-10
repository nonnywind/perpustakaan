<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $title = 'List Buku';
        $data = \DB::table('m_buku as b')->join('m_kategori as k', 'b.kategori', '=', 'k.id')->select('b.gambar', 'b.judul', 'k.nama', 'b.penulis', 'b.stock', 'b.created_at', 'b.id')->get();

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

        \Session::flash('sukses', 'Buku berhasil ditambahkan');

        return redirect('master/buku');
    }

    public function edit($id)
    {
        $title = 'Edit Buku';
        $dt = \DB::table('m_buku')->where('id', $id)->first();
        $kategori = \DB::table('m_kategori')->get();

        return view('buku.buku_edit', compact('title', 'dt', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $judul = $request->judul;
        $keterangan = $request->keterangan;
        $stock = $request->stock;
        $kategori = $request->kategori;
        $penulis = $request->penulis;

        $file = $request->file('image');

        if ($file) {
            \DB::table('m_buku')->where('id', $id)->update([
                'judul' => $judul,
                'keterangan' => $keterangan,
                'stock' => $stock,
                'kategori' => $kategori,
                'penulis' => $penulis,
                'gambar' => $file->getClientOriginalName(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $destinationPath = 'uploads';
            $file->move($destinationPath, $file->getClientOriginalName());
        } else {
            \DB::table('m_buku')->update([
                'judul' => $judul,
                'keterangan' => $keterangan,
                'stock' => $stock,
                'kategori' => $kategori,
                'penulis' => $penulis,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        \Session::flash('sukses', 'Buku berhasil diupdate');

        return redirect('master/buku');
    }

    public function delete($id)
    {
        \DB::table('m_buku')->where('id', $id)->delete();

        \Session::flash('sukses', 'Buku berhasil dihapus');

        return redirect('master/buku');
    }
}
