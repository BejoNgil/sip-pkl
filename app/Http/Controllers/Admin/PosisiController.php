<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Posisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PosisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posisi = Posisi::all();

        return view('administrator.posisi.index', compact('posisi'));
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
            'nama' => 'required|string|unique:posisi,nama',
        ]);

        Posisi::create($validated);

        Session::forget('showCreateModal');
        Session::flash('success', 'Berhasil Menambahkan Posisi');

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posisi  $posisi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Posisi $posisi)
    {
        Session::flash('showModal', $posisi['id']);

        $validated = $request->validate([
            'nama' => 'required|string|unique:posisi,nama,' . $posisi['id'],
        ]);

        $posisi->update($validated);

        Session::forget('showModal');
        Session::flash('success', 'Berhasil Mengubah Data Posisi');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Posisi $posisi
     * @return string
     * @throws \Exception
     */
    public function destroy(Posisi $posisi)
    {
        $posisi->delete();

        Session::flash('success', 'Berhasil Menghapus Data Posisi');

        return route('posisi.index');
    }
}
