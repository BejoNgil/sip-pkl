<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\PKL;
use Carbon\Carbon;
use Dompdf\Dompdf;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Penilaian;


class PrintSuratController extends Controller
{
    public function __invoke(PKL $pkl)
    {
        abort_unless($pkl->tanggal_selesai != null, 403);
        $qrcode = QrCode::size(100)
            ->format('svg')
            ->generate('Eko Sulistyono', storage_path('app/public/qrcodes/'.'qrcode'.'.svg'));
        $pkl->load('peserta.sekolah');
        $user = auth()->user();

        $nilai = Penilaian::with('kategori')->whereHas('pkl', function ($query) use ($user) {
            return $query->where('peserta_id', $user->authenticable_id);
        })->get();
        //dd($nilai);

        $sum = $nilai->sum('nilai');
        $count = $nilai->count();
        $total = $count > 0 ? round($sum / $count, 2) : 0;
        $data['nilai'] = $nilai;
        $data['total'] = $total;

        $data['nama'] = $pkl->peserta->nama;
        $data['nis'] = $pkl->peserta->nis;
        $data['sekolah'] = $pkl->peserta->sekolah->nama;
        $data['tglMulai'] = Carbon::parse($pkl->tanggal_mulai)->format('d F Y');
        $data['tglSelesai'] = Carbon::parse($pkl->tanggal_selesai)->format('d F Y');
        $data['tanggal'] = $data['tglSelesai'];
        $data['qrcode'] = $qrcode;
        $pdf = PDF::loadView('peserta.print-surat', ['data' => $data])->setPaper('A4');
        return $pdf->stream();
        //return $pdf->download('surat-keterangan-selesai-pkl.pdf');
    }
}
