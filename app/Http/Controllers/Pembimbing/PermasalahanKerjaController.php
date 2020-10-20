<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\PermasalahanKerja;
use App\PKL;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermasalahanKerjaController extends Controller
{
    public function index()
    {
        $permasalahanKerja = PermasalahanKerja::with('pkl.peserta')->whereHas('pkl', function (Builder $query) {
            return $query->where('pembimbing_id', auth()->user()->authenticable_id);
        })->get();

        return view('pembimbing.permasalahan-kerja.index', compact('permasalahanKerja'));
    }

    public function update(Request $request, PermasalahanKerja $permasalahanKerja)
    {
        Session::flash('showModal', $permasalahanKerja['id']);

        $validated = $request->validate([
            'solusi' => 'required|string'
        ]);

        $permasalahanKerja->update($validated);

        Session::forget('showModal');
        Session::flash('success', 'Berhasil disimpan');

        return redirect()->back();
    }
}
