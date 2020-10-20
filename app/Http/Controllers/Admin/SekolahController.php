<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sekolah = Sekolah::all();

        return view('administrator.sekolah.index', compact('sekolah'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Session::flash('showCreateModal', true);

        $validated = $request->validate([
            'nama' => 'required|string|unique:sekolah,nama',
            'telepon' => 'sometimes|nullable|numeric',
            'alamat' => 'sometimes|nullable|string'
        ]);

        Sekolah::create($validated);

        Session::forget('showCreateModal');
        Session::flash('success', 'Berhasil Menambahkan Sekolah');

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Sekolah $sekolah
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Sekolah $sekolah)
    {
        Session::flash('showModal', $sekolah['id']);

        $validated = $request->validate([
            'nama' => 'required|string|unique:sekolah,nama,' . $sekolah['id'],
            'telepon' => 'sometimes|nullable|numeric',
            'alamat' => 'sometimes|nullable|string'
        ]);

        $sekolah->update($validated);

        Session::forget('showModal');
        Session::flash('success', 'Berhasil Mengubah Data Sekolah');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Sekolah $sekolah
     * @return string
     * @throws \Exception
     */
    public function destroy(Sekolah $sekolah)
    {
        $sekolah->delete();

        Session::flash('success', 'Berhasil Menghapus Data Sekolah');

        return route('sekolah.index');
    }
}
