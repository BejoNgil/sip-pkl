<?php

namespace App\Http\Controllers\Peserta;

use App\Absensi;
use App\Http\Controllers\Controller;
use App\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::where('peserta_id', auth()->user()->authenticable_id)
            ->where('tanggal', today())->first();

        $historyAbsensi = Absensi::where('peserta_id', auth()->user()->authenticable_id)->paginate(10);

        return view('peserta.absensi.index', compact('absensi', 'historyAbsensi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:masuk,pulang'
        ]);

        $absensi = Absensi::where('peserta_id', auth()->user()->authenticable_id)
            ->where('tanggal', today())->first();

        if ($absensi) {
            $absensi->update([
                'jam_pulang' => now()->format('H:i:s')
            ]);
            Session::flash('success', 'Absen pulang anda tersimpan');
        } else {
            if ($validated['type'] === 'pulang') {
                Session::flash('warning', 'Anda belum absen masuk!');
            } else {
                Absensi::create([
                    'peserta_id' => auth()->user()->authenticable_id,
                    'tanggal' => today(),
                    'jam_masuk' => now()->format('H:i:s')
                ]);
                Session::flash('success', 'Absen masuk anda tersimpan');
            }
        }

        return redirect()->back();
    }
}
