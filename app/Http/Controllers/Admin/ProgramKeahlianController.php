<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProgramKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProgramKeahlianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $programKeahlian = ProgramKeahlian::withCount('peserta')->get();

        return view('administrator.program-keahlian.index', compact('programKeahlian'));
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
            'nama' => 'required|string|unique:program_keahlian,nama',
        ]);

        ProgramKeahlian::create($validated);

        Session::forget('showCreateModal');
        Session::flash('success', 'Berhasil Menambahkan Program Keahlian');

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProgramKeahlian  $programKeahlian
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ProgramKeahlian $programKeahlian)
    {
        Session::flash('showModal', $programKeahlian['id']);

        $validated = $request->validate([
            'nama' => 'required|string|unique:program_keahlian,nama,' . $programKeahlian['id'],
        ]);

        $programKeahlian->update($validated);

        Session::forget('showModal');
        Session::flash('success', 'Berhasil Mengubah Data Program Keahlian');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ProgramKeahlian $programKeahlian
     * @return string
     * @throws \Exception
     */
    public function destroy(ProgramKeahlian $programKeahlian)
    {
        $programKeahlian->delete();

        Session::flash('success', 'Berhasil Menghapus Data Program Keahlian');

        return route('program-keahlian.index');
    }
}
