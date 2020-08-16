<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $title = 'List Laporan';
        $data = Peminjaman::get();

        return view('laporan.index', compact('title', 'data'));
    }

    public function periode(Request $request)
    {
        $tanggal_awal = date('Y-m-d', strtotime($request->tanggal_awal));
        $tanggal_akhir = date('Y-m-d', strtotime($request->tanggal_akhir));

        $title = "List laporan dari tanggal $tanggal_awal sampai tanggal $tanggal_akhir";
        $data = Peminjaman::where('created_at', '>=', $tanggal_awal . ' 00:00:00')->where('created_at', '<=', $tanggal_akhir . ' 23:59:59')->get();

        return view('laporan.index', compact('title', 'data'));
    }
}
