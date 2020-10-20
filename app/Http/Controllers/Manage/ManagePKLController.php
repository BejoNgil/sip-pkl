<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\PKL;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

        $validated = $request->validate([
            'peserta_id' => 'required|exists:peserta,id',
            'pembimbing_id' => 'required|exists:pembimbing,id',
            'posisi_id' => 'required|exists:posisi,id',
            'tanggal_mulai' => 'required|date',
        ]);

        Session::forget('showCreateModal');

        PKL::create($validated);

        Session::flash('success', 'Berhasil Menugaskan Peserta');

        return redirect()->back();
    }
}
