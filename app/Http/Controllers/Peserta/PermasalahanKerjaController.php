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
        $permasalahanKerja = PermasalahanKerja::with([
                                    'detail_masalah', 'respon_pembimbing' => function($sql){
                                        $sql->whereNotIn('user_id', [auth()->user()->id]);
                                    }
                                ])
                                ->whereHas('detail_masalah', function($sql){
                                    $sql->orderBy('id', 'ASC')->limit(1);
                                })
                                ->where('pkl_id', $pkl['id'])->orderBy('id', 'DESC')->get();
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
        $detailPermasalahan->user_id = auth()->user()->id;
        $detailPermasalahan->save();

        Session::forget('showCreateModal');
        Session::flash('success', 'Berhasil menambahkan data');

        return redirect()->back();
    }

    public function update(Request $request, PermasalahanKerja $permasalahanKerja)
    {

        //if($permasalahanKerja['solusi'] != null) return abort('403');

        Session::flash('showModal', $permasalahanKerja['id']);

        $this->validate($request, [
            'tanggal' => 'required|date',
            'description' => 'required|string',
            'topik' => 'required|string'
        ]);

        $permasalahanKerja = PermasalahanKerja::find($permasalahanKerja->id);
        $permasalahanKerja->tanggal = $request->tanggal;
        $permasalahanKerja->topik = $request->topik;
        $permasalahanKerja->status = 0;
        $permasalahanKerja->pkl_id = auth()->user()->authenticable->pkl->id;
        $permasalahanKerja->update();

        $detailPermasalahan = DetailPermasalahan::where('permasalahan_kerja_id', $permasalahanKerja->id)->first();
        $detailPermasalahan->permasalahan_kerja_id = $permasalahanKerja->id;
        $detailPermasalahan->description = $request->description;
        $detailPermasalahan->user_id = auth()->user()->id;
        $detailPermasalahan->update();

        Session::forget('showModal');
        Session::flash('success', 'Berhasil mengubah data');

        return redirect()->back();
    }

    public function destroy(PermasalahanKerja $permasalahanKerja)
    {
        $permasalahanKerja->delete();
        $detailPermasalahan = DetailPermasalahan::where('permasalahan_kerja_id', $permasalahanKerja->id);
        $detailPermasalahan->delete();

        Session::flash('success', 'Berhasil menghapus data');

        return route('permasalahan-kerja.index');
    }

    public function show($id)
    {
        $permasalahanKerja = PermasalahanKerja::with('pkl')->find($id);
        $detailPermasalahan = DetailPermasalahan::where('permasalahan_kerja_id', $id)->orderBy('id', 'DESC')->get();
        return view('peserta.permasalahan-kerja.show', compact('permasalahanKerja', 'detailPermasalahan'));
    }

    public function detailMasalah(Request $request, $id)
    {
        $detailPermasalahan = new DetailPermasalahan();
        $detailPermasalahan->permasalahan_kerja_id = $id;
        $detailPermasalahan->description = $request->description;
        $detailPermasalahan->user_id = auth()->user()->id;
        $detailPermasalahan->save();
        Session::flash('success', 'Berhasil Merespon Pembimbing');

        return redirect()->back();
    }

    public function close(Request $request, $id)
    {
        $permasalahanKerja = PermasalahanKerja::find($id);
        $permasalahanKerja->status = 1;
        $permasalahanKerja->update();
        Session::flash('success', 'Permasalahan Kerja Di Tutup');

        return redirect()->back();
    }
}
