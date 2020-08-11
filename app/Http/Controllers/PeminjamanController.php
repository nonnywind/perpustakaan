<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    public function index()
    {
        $title = 'Peminjaman Buku All';
        $data = Peminjaman::get();

        return view('peminjaman.index', compact('title', 'data'));
    }

    public function store($id)
    {
        $cek = \DB::table('m_buku')->where('id', $id)->where('stock', '>', 0)->where('status', 1)->count();

        if ($cek > 0) {
            \DB::table('peminjaman')->where('id', $id)->insert([
                'buku' => $id,
                'user' => \Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $buku = \DB::table('m_buku')->where('id', $id)->first();
            $qty_now = $buku->stock;
            $qty_new = $qty_now - 1;

            \DB::table('m_buku')->where('id', $id)->update([
                'stock' => $qty_new
            ]);

            \Session::flash('sukses', 'Buku berhasil dipinjam');

            return redirect('master/buku');
        } else {
            \Session::flash('gagal', 'Buku sudah habis atau tidak aktif');

            return redirect('master/buku');
        }
    }

    public function setujui($id)
    {
        Peminjaman::where('id', $id)->update([
            'status' => 1
        ]);

        return redirect('pinjam-buku');
    }
}
