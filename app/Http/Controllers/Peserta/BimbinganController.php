<?php

namespace App\Http\Controllers\Peserta;

use App\Bimbingan;
use App\Http\Controllers\Controller;
use App\PKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BimbinganController extends Controller
{
    public function index()
    {
        $pkl = PKL::with('pembimbing')->wherePesertaId(auth()->user()->authenticable_id)->first();
        $bimbingan = Bimbingan::where('pkl_id', $pkl['id'])->get();

        return view('peserta.bimbingan.index', compact('bimbingan','pkl'));
    }

    public function store(Request $request)
    {
        Session::flash('showCreateModal');

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'uraian' => 'required|string'
        ]);

        Bimbingan::create($validated + ['pkl_id' => auth()->user()->authenticable->pkl->id]);

        Session::forget('showCreateModal');
        Session::flash('success', 'Berhasil menambahkan bimbingan');

        return redirect()->back();
    }

    public function update(Request $request, Bimbingan $bimbingan)
    {
        if($bimbingan['is_approve']) return abort('403');

        Session::flash('showModal', $bimbingan['id']);

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'uraian' => 'required|string'
        ]);

        $bimbingan->update($validated);

        Session::forget('showModal');
        Session::flash('success', 'Berhasil mengubah bimbingan');

        return redirect()->back();
    }

    public function destroy(Bimbingan $bimbingan)
    {
        $bimbingan->delete();

        Session::flash('success', 'Berhasil menghapus bimbingan');

        return route('bimbingan.index');
    }
}
