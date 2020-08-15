<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    public function index()
    {
        $title = 'Pengembalian Buku';
        $data = Peminjaman::whereIn('status', [1, 3])->get();

        return view('pengembalian.index', compact('title', 'data'));
    }

    public function pengembalian($id)
    {
        Peminjaman::where('id', $id)->update([
            'status' => 3
        ]);

        return redirect('pengembalian-buku');
    }
}
