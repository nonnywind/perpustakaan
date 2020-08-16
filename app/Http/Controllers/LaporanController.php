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
}
