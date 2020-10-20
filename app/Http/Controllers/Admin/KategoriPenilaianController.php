<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\KategoriPenilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KategoriPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $kategori = KategoriPenilaian::all();

        return view('administrator.kategori-penilaian.index', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Session::flash('showCreateModal', true);

        $validated = $request->validate([
            'nama' => 'required|string|unique:kategori_penilaian,nama',
        ]);

        KategoriPenilaian::create($validated);

        Session::forget('showCreateModal');
        Session::flash('success', 'Berhasil Menambahkan Kategori Penilaian');

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KategoriPenilaian  $kategori
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, KategoriPenilaian $kategori)
    {
        Session::flash('showModal', $kategori['id']);

        $validated = $request->validate([
            'nama' => 'required|string|unique:kategori_penilaian,nama,' . $kategori['id'],
        ]);

        $kategori->update($validated);

        Session::forget('showModal');
        Session::flash('success', 'Berhasil Mengubah Data Kategori Penilaian');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\KategoriPenilaian $kategori
     * @return string
     * @throws \Exception
     */
    public function destroy(KategoriPenilaian $kategori)
    {
        $kategori->delete();

        Session::flash('success', 'Berhasil Menghapus Data Kategori Penilaian');

        return route('kategori.index');
    }
}
