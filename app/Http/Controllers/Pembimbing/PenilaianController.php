<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\KategoriPenilaian;
use App\Penilaian;
use App\PKL;
use Illuminate\Database\Schema\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PenilaianController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $listPKL = PKL::with(['peserta.sekolah', 'posisi', 'nilai'])
            ->where('pembimbing_id', $user->authenticable_id)->get();

        $kategoriPenilaian = KategoriPenilaian::all();

        return view('pembimbing.penilaian.index', compact('listPKL', 'kategoriPenilaian'));
    }

    public function assignNilai(Request $request, PKL $pkl)
    {
        Session::flash('showModal', $pkl['id']);

        $validated = $request->validate([
            'nilai.id.*' => 'required|exists:kategori_penilaian,id',
            'nilai.value.*' => 'required|integer|between:1,100',
            'nilai.keterangan.*' => 'sometimes|nullable',
            'type' => 'required|in:store,update'
        ]);
        DB::beginTransaction();

        try {
            foreach ($validated['nilai']['id'] as $i => $item) {
                if ($validated['type'] === 'store') {
                    $pkl->nilai()->create([
                        'kategori_penilaian_id' => $item,
                        'nilai' => $validated['nilai']['value'][$i],
                        'keterangan' => $validated['nilai']['keterangan'][$i],
                    ]);
                    $pkl->update(['tanggal_selesai' => now()]);
                } else {
                    Penilaian::where('pkl_id', $pkl['id'])->where('kategori_penilaian_id', $item)->update([
                        'nilai' => $validated['nilai']['value'][$i],
                        'keterangan' => $validated['nilai']['keterangan'][$i],
                    ]);
                }
            }
            DB::commit();
            Session::forget('showModal');
            Session::flash('success', 'Berhasil Memberi Nilai');
        } catch (\Throwable $e) {
            DB::rollBack();
            Session::flash('error', 'Terjadi Kesalahan');
        }

        return redirect()->back();

    }
}
