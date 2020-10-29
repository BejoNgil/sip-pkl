<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\PKL;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class ManagePKLController extends Controller
{
    public function index()
    {
        $listPKL = PKL::with(['peserta', 'posisi', 'pembimbing'])->newQuery();

        $user = auth()->user();

        $listPKL->when($user->role === 'pembimbing', function (Builder $query) use ($user) {
            return $query->where('pembimbing_id', $user->authenticable_id);
        });

        $listPKL = $listPKL->get();

        return view('manage-pkl.index', compact('listPKL'));
    }

    public function store(Request $request)
    {
        Session::flash('showCreateModal', true);

        $request->validate([
            'peserta_id' => 'required|exists:peserta,id',
            'pembimbing_id' => 'required|exists:pembimbing,id',
            'posisi_id' => 'required|exists:posisi,id',
            'tanggal_mulai' => 'required|date',
        ]);
        $dt = Carbon::create($request->tanggal_mulai);
        Session::forget('showCreateModal');
        $pkl = new PKL();
        $pkl->peserta_id = $request->peserta_id;
        $pkl->pembimbing_id = $request->pembimbing_id;
        $pkl->posisi_id = $request->posisi_id;
        $pkl->tanggal_mulai = $request->tanggal_mulai;
        $pkl->tanggal_selesai = date('Y-m-d', strtotime($dt->addDays(30)));
        $pkl->save();

        Session::flash('success', 'Berhasil Menugaskan Peserta');

        return redirect()->back();
    }
}
