<?php

namespace App\Http\Controllers\Peserta;

use App\DetailPermasalahan;
use App\Http\Controllers\Controller;
use App\PermasalahanKerja;
use App\PKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermasalahanKerjaController extends Controller
{
    public function index()
    {
        $pkl = PKL::with('pembimbing')->wherePesertaId(auth()->user()->authenticable_id)->first();
        $permasalahanKerja = PermasalahanKerja::where('pkl_id', $pkl['id'])->orderBy('id', 'DESC')->get();

        return view('peserta.permasalahan-kerja.index', compact('permasalahanKerja','pkl'));
    }

    public function store(Request $request)
    {
        Session::flash('showCreateModal');
        $this->validate($request, [
            'tanggal' => 'required|date',
            'description' => 'required|string',
            'topik' => 'required|string'
        ]);

        $permasalahanKerja = new PermasalahanKerja();
        $permasalahanKerja->tanggal = $request->tanggal;
        $permasalahanKerja->topik = $request->topik;
        $permasalahanKerja->status = 0;
        $permasalahanKerja->pkl_id = auth()->user()->authenticable->pkl->id;
        $permasalahanKerja->save();

        $detailPermasalahan = new DetailPermasalahan();
        $detailPermasalahan->permasalahan_kerja_id = $permasalahanKerja->id;
        $detailPermasalahan->description = $request->description;
        $detailPermasalahan->user_id = auth()->user()->authenticable->pkl->id;
        $detailPermasalahan->save();

        Session::forget('showCreateModal');
        Session::flash('success', 'Berhasil menambahkan data');

        return redirect()->back();
    }

    public function update(Request $request, PermasalahanKerja $permasalahanKerja)
    {
        if($permasalahanKerja['solusi'] != null) return abort('403');

        Session::flash('showModal', $permasalahanKerja['id']);

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'masalah' => 'required|string'
        ]);

        $permasalahanKerja->update($validated);

        Session::forget('showModal');
        Session::flash('success', 'Berhasil mengubah data');

        return redirect()->back();
    }

    public function destroy(PermasalahanKerja $permasalahanKerja)
    {
        $permasalahanKerja->delete();

        Session::flash('success', 'Berhasil menghapus data');

        return route('permasalahan-kerja.index');
    }
}
