<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function store($id)
    {
        \DB::table('peminjaman')->where('id', $id)->insert([
            'buku' => $id,
            'user' => \Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect('master/buku');
    }
}
