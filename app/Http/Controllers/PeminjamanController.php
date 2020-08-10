<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function store($id)
    {
        $cek = \DB::table('m_buku')->where('id', $id)->where('stock', '>', 0)->where('status', 1)->count();

        if ($cek > 0) {
            \DB::table('peminjaman')->where('id', $id)->insert([
                'buku' => $id,
                'user' => \Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            \Session::flash('sukses', 'Buku berhasil dipinjam');

            return redirect('master/buku');
        } else {
            \Session::flash('gagal', 'Buku sudah habis atau tidak aktif');

            return redirect('master/buku');
        }
    }
}
