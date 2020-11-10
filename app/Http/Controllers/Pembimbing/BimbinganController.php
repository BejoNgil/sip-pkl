<?php

namespace App\Http\Controllers\Pembimbing;

use App\Bimbingan;
use App\Http\Controllers\Controller;
use App\Peserta;
use App\PKL;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BimbinganController extends Controller
{
    public function index()
    {
        $pkl = PKL::with([
            'peserta', 'bimbingan_one'])
                ->get();
        $bimbingan = Bimbingan::with('pkl.peserta')->whereHas('pkl', function (Builder $query) {
            return $query->where('pembimbing_id', auth()->user()->authenticable_id);
        })->get();

        return view('pembimbing.bimbingan.index', compact('bimbingan', 'pkl'));
    }

    public function approve(Request $request, Bimbingan $bimbingan)
    {
        if ($bimbingan->is_approve) return abort(403);

        $bimbingan->update(['is_approve' => true]);

        Session::flash('success', 'Bimbingan telah disetujui');

        return redirect()->back();
    }

    public function show($id)
    {
        $bimbingan = Bimbingan::with('pkl.peserta')
        ->where('pkl_id', $id)
        ->orderBy('id', 'DESC')
        ->get();
        return view('pembimbing.bimbingan.show', compact('bimbingan'));
    }
}
