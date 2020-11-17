<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekolah;
use App\ProgramKeahlian;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Crypt;
use App\Mail\NotifVerifikasiPeserta;
use App\Peserta;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PendaftaranController extends Controller
{
    //
    public function index()
    {
        $sekolah = Sekolah::all();
        $programKeahlian = ProgramKeahlian::get();
        return view('pendaftaran.index', compact('sekolah', 'programKeahlian'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user,email',],
            'nis' => 'required|numeric|unique:peserta,nis',
            'jenis_kelamin' => 'required|in:L,P',
            'sekolah_id' => 'required_without:sekolah.nama|exists:sekolah,id',
            'program_keahlian_id' => 'required_without:program.nama|nullable|exists:program_keahlian,id',
            'sekolah.nama' => 'required_without:sekolah_id|unique:sekolah,nama',
            'sekolah.telepon' => 'sometimes|nullable',
            'sekolah.alamat' => 'sometimes|nullable',
            'program.nama' => 'required_without:program_keahlian_id|unique:program_keahlian,nama',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($request['sekolah']['nama'] ?? null) {
            $sekolah = Sekolah::create($request['sekolah']);
        }

        if ($request['program']['nama'] ?? null) {
            $program = ProgramKeahlian::create($request['program']);
        }
        //$peserta = Peserta::create($data);
        $peserta = new Peserta();
        $peserta->nama = $request->nama;
        $peserta->nis = $request->nis;
        $peserta->jenis_kelamin = $request->jenis_kelamin;
        $peserta->sekolah_id = ($request->sekolah_id == '') ? $sekolah->id : $request->sekolah_id;
        $peserta->program_keahlian_id = ($request->program_keahlian_id == '') ? $program->id : $request->program_keahlian_id;
        $peserta->save();


        $user = $peserta->authenticable()->create($request->all());
        /*
        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->authenticable_type = 'App\Pembimbing';
        $user->authenticable_id = $peserta->id;
        $user->save();*/

        //Auth::login($user);
        $hash = Crypt::encrypt($peserta->id);
        $url = url('peserta/confirmation?hash='.$hash);
        Mail::to($request->email)->send(new NotifVerifikasiPeserta($request->nama, $url));
        Session::flash('success', 'Mendaftar Sebagai Peserta PKL, Silahkan Cek email untuk verifikasi !!');
        return redirect()->route('pendaftaran.index');
    }

    public function success()
    {
        return view('pendaftaran.success');
    }
}
