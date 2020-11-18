<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pembimbing;
use App\PKL;
use App\Posisi;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    //
    public function index()
    {
        $divisi = Posisi::pluck('nama', 'id');
        $divisi->prepend('Semua Divisi', '0');
        $pembimbing = Pembimbing::pluck('nama', 'id');
        $pembimbing->prepend('Semua Pembimbing', '0');
        return view('report.laporan-pkl', compact('divisi', 'pembimbing'));
    }

    public function exportPdf(Request $request)
    {
        $this->validate($request, [
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'pembimbing' => 'required',
            'divisi' => 'required'
        ]);
        if($request->pembimbing == 0 & $request->divisi == 0)
        {
            $data['pkl'] = PKL::with(['peserta', 'pembimbing', 'posisi', 'nilai'])->whereBetween('tanggal_mulai', [$request->tgl_mulai, $request->tgl_selesai])
                    ->whereBetween('tanggal_selesai', [$request->tgl_mulai, $request->tgl_selesai])
                    ->get();
        }else if($request->pembimbing != 0 & $request->divisi == 0)
        {
            $data['pkl'] = PKL::with(['peserta', 'pembimbing', 'posisi', 'nilai'])->whereBetween('tanggal_mulai', [$request->tgl_mulai, $request->tgl_selesai])
                    ->whereBetween('tanggal_selesai', [$request->tgl_mulai, $request->tgl_selesai])
                    ->where('pembimbing_id', $request->pembimbing)
                    ->get();
        }else if($request->pembimbing == 0 & $request->divisi != 0) {
            $data['pkl'] = PKL::with(['peserta', 'pembimbing', 'posisi', 'nilai'])->whereBetween('tanggal_mulai', [$request->tgl_mulai, $request->tgl_selesai])
                    ->whereBetween('tanggal_selesai', [$request->tgl_mulai, $request->tgl_selesai])
                    ->where('posisi_id', $request->divisi)
                    ->get();
        }else {
            $data['pkl'] = PKL::with(['peserta', 'pembimbing', 'posisi', 'nilai'])->whereBetween('tanggal_mulai', [$request->tgl_mulai, $request->tgl_selesai])
                    ->whereBetween('tanggal_selesai', [$request->tgl_mulai, $request->tgl_selesai])
                    ->where('posisi_id', $request->divisi)
                    ->where('pembimbing_id', $request->pembimbing)
                    ->get();
        }

        $pdf = PDF::loadView('pdf.laporan-pkl', ['data' => $data])->setPaper('A4');
        //return $pdf->stream();
        return $pdf->download('surat-laporan-pkl.pdf');
    }
}
