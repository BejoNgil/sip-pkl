<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\PKL;
use Carbon\Carbon;
use PDF;

class PrintSuratController extends Controller
{
    public function __invoke(PKL $pkl)
    {
        abort_unless($pkl->tanggal_selesai != null, 403);

        $pkl->load('peserta.sekolah');

        $data['nama'] = $pkl->peserta->nama;
        $data['nis'] = $pkl->peserta->nis;
        $data['sekolah'] = $pkl->peserta->sekolah->nama;
        $data['tglMulai'] = Carbon::parse($pkl->tanggal_mulai)->format('d F Y');
        $data['tglSelesai'] = Carbon::parse($pkl->tanggal_selesai)->format('d F Y');
        $data['tanggal'] = $data['tglSelesai'];

        $pdf = PDF::loadView('peserta.print-surat', $data)->setPaper('A4');

        return $pdf->download('surat-keterangan-selesai-pkl.pdf');
    }
}
