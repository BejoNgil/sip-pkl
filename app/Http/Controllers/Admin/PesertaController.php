<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Peserta;
use App\ProgramKeahlian;
use App\Sekolah;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Mail\NotifVerifikasiPeserta;
use App\User;
use Illuminate\Support\Facades\Mail;
use Crypt;


class PesertaController extends Controller
{
    public function index()
    {
        $peserta = Peserta::with(['authenticable', 'sekolah', 'programKeahlian'])->get();

        return view('administrator.peserta.index', compact('peserta'));
    }

    public function create()
    {
        $sekolah = Sekolah::all();
        $programKeahlian = ProgramKeahlian::get();

        return view('administrator.peserta.create', compact('sekolah', 'programKeahlian'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:user,email',
            'nis' => 'required|numeric|unique:peserta,nis',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'sometimes|nullable|date',
            'alamat' => 'sometimes|nullable',
            'foto' => 'sometimes|nullable|mimes:png,jpg,jpeg|max:80000',
            'sekolah_id' => 'required_without:sekolah.nama|exists:sekolah,id',
            'program_keahlian_id' => 'required_without:program.nama|nullable|exists:program_keahlian,id',
            'sekolah.nama' => 'required_without:sekolah_id|unique:sekolah,nama',
            'sekolah.telepon' => 'sometimes|nullable',
            'sekolah.alamat' => 'sometimes|nullable',
            'program.nama' => 'required_without:program_keahlian_id|unique:program_keahlian,nama',
            'telepon' => 'sometimes|nullable|numeric',
            'ayah' => 'sometimes|nullable',
            'ibu' => 'sometimes|nullable'
        ]);

        DB::beginTransaction();

        try {
            if ($validated['sekolah']['nama'] ?? null) {
                $sekolah = Sekolah::create($validated['sekolah']);
                $validated['sekolah_id'] = $sekolah['id'];
            }

            if ($validated['program']['nama'] ?? null) {
                $program = ProgramKeahlian::create($validated['program']);
                $validated['program_keahlian_id'] = $program['id'];
            }

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $path = 'assets/foto/';
                $file->storePubliclyAs($path, $filename);
                $fullPath = $path . $filename;
                $validated['foto'] = $fullPath;
            }

            $peserta = Peserta::create($validated);
            $peserta->authenticable()->create(
                $validated + ['password' => 'password']
            );

            Session::flash('success', 'Berhasil Menambahkan Siswa');
            DB::commit();

            $hash = Crypt::encrypt($peserta->id);
            $url = url('peserta/confirmation?hash='.$hash);
            Mail::to($request->email)->send(new NotifVerifikasiPeserta($request->nama, $url));
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', 'Terjadi Kesalahan pada Sistem');
            return redirect()->back();
        }

        return redirect()->route('peserta.index');
    }

    public function edit(Peserta $peserta)
    {
        $sekolah = Sekolah::all();
        $programKeahlian = ProgramKeahlian::get();

        $peserta->load(['authenticable']);

        return view('administrator.peserta.edit', compact('peserta', 'sekolah', 'programKeahlian'));
    }

    public function resetPassword(Peserta $peserta)
    {
        $peserta->authenticable->update(['password' => 'password']);

        Session::flash('success','Berhasil mereset password peserta');

        return route('peserta.edit', $peserta);
    }

    public function update(Request $request, Peserta $peserta)
    {

        $validated = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:user,email,' . $peserta['authenticable']['id'],
            'nis' => 'required|numeric|unique:peserta,nis,' . $peserta['id'],
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'sometimes|nullable|date',
            'alamat' => 'sometimes|nullable',
            'foto' => 'sometimes|nullable|mimes:png,jpg,jpeg|max:80000',
            'sekolah_id' => 'required_without:sekolah.nama|exists:sekolah,id',
            'program_keahlian_id' => 'required_without:program.nama|nullable|exists:program_keahlian,id',
            'sekolah.nama' => 'required_without:sekolah_id|unique:sekolah,nama',
            'sekolah.telepon' => 'sometimes|nullable',
            'sekolah.alamat' => 'sometimes|nullable',
            'program.nama' => 'required_without:program_keahlian_id|unique:program_keahlian,nama',
            'telepon' => 'sometimes|nullable|numeric',
            'ayah' => 'sometimes|nullable',
            'ibu' => 'sometimes|nullable'
        ]);

        DB::beginTransaction();

        try {
            if ($validated['sekolah']['nama'] ?? null) {
                $sekolah = Sekolah::create($validated['sekolah']);
                $validated['sekolah_id'] = $sekolah['id'];
            }

            if ($validated['program']['nama'] ?? null) {
                $program = ProgramKeahlian::create($validated['program']);
                $validated['program_keahlian_id'] = $program['id'];
            }

            if ($request->hasFile('foto')) {
                $oldPath = $peserta['foto'];
                $file = $request->file('foto');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $path = 'assets/foto/';
                $file->storePubliclyAs($path, $filename,'public');
                $fullPath = $path . $filename;
                $validated['foto'] = $fullPath;
                if ($oldPath) Storage::disk('public')->delete($oldPath);
            }

            $peserta->update($validated);
            $peserta->authenticable->update($validated);

            Session::flash('success', 'Berhasil Mengubah Data Siswa');
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', 'Terjadi Kesalahan pada Sistem');
            return redirect()->back();
        }

        return redirect()->route('peserta.index');
    }

    public function destroy(Peserta $peserta)
    {
        $peserta->authenticable->delete();
        $peserta->delete();

        Session::flash('success', 'Berhasil menghapus peserta');

        return route('peserta.index');
    }
}
