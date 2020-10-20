<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Penilaian;
use App\PKL;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $nilai = Penilaian::with('kategori')->whereHas('pkl', function ($query) use ($user) {
            return $query->where('peserta_id', $user->authenticable_id);
        })->get();

        $sum = $nilai->sum('nilai');
        $count = $nilai->count();
        $total = $count > 0 ? round($sum / $count, 2) : 0;

        $pkl = PKL::with('pembimbing')->where('peserta_id', $user->authenticable_id)->first();

        return view('peserta.penilaian.index', compact('nilai', 'total','pkl'));
    }
}
