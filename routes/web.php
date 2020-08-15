<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('beranda');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('beranda', 'BerandaController@index');

    // Master Kategori
    Route::get('master/kategori', 'KategoriController@index');
    Route::get('master/kategori/add', 'KategoriController@add');
    Route::post('master/kategori/add', 'KategoriController@store');
    Route::get('master/kategori/{id}', 'KategoriController@edit');
    Route::put('master/kategori/{id}', 'KategoriController@update');
    Route::delete('master/kategori/{id}', 'KategoriController@delete');

    // Master buku
    Route::get('master/buku', 'BukuController@index');
    Route::get('master/buku/kosong', 'BukuController@kosong');
    Route::get('master/buku/nonaktif', 'BukuController@nonaktif');
    Route::get('master/buku/add', 'BukuController@add');
    Route::post('master/buku/add', 'BukuController@store');
    Route::get('master/buku/{id}', 'BukuController@edit');
    Route::put('master/buku/{id}', 'BukuController@update');
    Route::delete('master/buku/{id}', 'BukuController@delete');
    Route::get('master/buku/status/{id}', 'BukuController@status');

    // Peminjaman Buku
    Route::get('pinjam-buku', 'PeminjamanController@index');
    route::get('pinjam-buku/{id}', 'PeminjamanController@store');

    Route::get('pinjam-buku/setujui/{id}', 'PeminjamanController@setujui');
    Route::get('pinjam-buku/tolak/{id}', 'PeminjamanController@tolak');

    // Pengembalian buku
    Route::get('pengembalian-buku', 'PengembalianController@index');
    Route::get('pengembalian-buku/{id}', 'PengembalianController@pengembalian');

    // Manage anggota
    Route::get('manage-anggota', 'AnggotaController@index');
    Route::get('manage-anggota/add', 'AnggotaController@add');
    Route::post('manage-anggota/add', 'AnggotaController@store');

    Route::get('manage-anggota/{id}', 'AnggotaController@edit');
    Route::put('manage-anggota/{id}', 'AnggotaController@update');
    Route::get('manage-anggota/delete/{id}', 'AnggotaController@delete');
});

Route::get('keluar', function () {
    \Auth::logout();
    return redirect('login');
});

Auth::routes();

Route::get('/home', function () {
    return redirect('beranda');
});
