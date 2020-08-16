<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peminjaman;
use App\Models\M_buku;

class PengembalianController extends Controller
{
    public function index()
    {
        $title = 'Pengembalian Buku';

        if (\Auth::user()->status == 1) {
            $data = Peminjaman::whereIn('status', [1, 3])->get();
        } else {
            $data = Peminjaman::whereIn('status', [1, 3])->where('user', \Auth::user()->id)->get();
        }

        return view('pengembalian.index', compact('title', 'data'));
    }

    public function pengembalian($id)
    {
        $dt = Peminjaman::find($id);
        $id_buku = $dt->buku;

        $buku = M_buku::find($id_buku);

        $now = $buku->stock;
        $stock_pengembalian = $now + 1;

        Peminjaman::where('id', $id)->update([
            'status' => 3
        ]);

        M_buku::where('id', $id)->update([
            'stock' => $stock_pengembalian
        ]);

        return redirect('pengembalian-buku');
    }
}
