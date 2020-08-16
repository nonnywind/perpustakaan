<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\User;

class LaporanController extends Controller
{
    public function index()
    {
        $title = 'List Laporan';
        $data = Peminjaman::get();
        $users = User::whereNull('status')->get();

        return view('laporan.index', compact('title', 'data', 'users'));
    }

    public function periode(Request $request)
    {
        $users = User::whereNull('status')->get();
        $tanggal_awal = date('Y-m-d', strtotime($request->tanggal_awal));
        $tanggal_akhir = date('Y-m-d', strtotime($request->tanggal_akhir));
        $user = $request->user;

        $title = "List laporan dari tanggal $tanggal_awal sampai tanggal $tanggal_akhir";

        if ($user == 'all') {
            $data = Peminjaman::where('created_at', '>=', $tanggal_awal . ' 00:00:00')
                ->where('created_at', '<=', $tanggal_akhir . ' 23:59:59')
                ->get();
        } else {
            $data = Peminjaman::where('created_at', '>=', $tanggal_awal . ' 00:00:00')
                ->where('created_at', '<=', $tanggal_akhir . ' 23:59:59')
                ->where('user', $user)
                ->get();
        }

        return view('laporan.index', compact('title', 'data', 'users'));
    }
}
