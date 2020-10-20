<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\LogKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LogKegiatanController extends Controller
{
    public function index()
    {
        $logKegiatan = LogKegiatan::where('peserta_id', auth()->user()->authenticable_id)->get();

        return view('peserta.log-kegiatan.index', compact('logKegiatan'));
    }

    public function store(Request $request)
    {
        Session::flash('showCreateModal');

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'uraian' => 'required|string'
        ]);

        LogKegiatan::create($validated + ['peserta_id' => auth()->user()->authenticable_id]);

        Session::forget('showCreateModal');
        Session::flash('success', 'Berhasil menambahkan log kegiatan');

        return redirect()->back();
    }

    public function update(Request $request, LogKegiatan $kegiatan)
    {
        Session::flash('showModal', $kegiatan['id']);

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s',
            'uraian' => 'required|string'
        ]);

        $kegiatan->update($validated);

        Session::forget('showModal');
        Session::flash('success', 'Berhasil mengubah log kegiatan');

        return redirect()->back();
    }

    public function destroy(LogKegiatan $kegiatan)
    {
        $kegiatan->delete();

        Session::flash('success', 'Berhasil menghapus log kegiatan');

        return route('kegiatan.index');
    }
}
