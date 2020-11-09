<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\ProgramKeahlian;
use App\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Crypt;
use App\User;
use Illuminate\Support\Carbon;

class ProfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $peserta = $user->authenticable;
        $sekolah = Sekolah::all();
        $programKeahlian = ProgramKeahlian::get();

        return view('peserta.profil', compact('user', 'peserta', 'sekolah', 'programKeahlian'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $peserta = $user->authenticable;

        $validated = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:user,email,' . $user['id'],
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
            $user->update($validated);

            Session::flash('success', 'Berhasil Mengubah Profil');
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', 'Terjadi Kesalahan pada Sistem');
            return redirect()->back();
        }

        return redirect()->route('peserta.profile');
    }

    public function confirmation(Request $request)
    {
        $verified = Carbon::now()->format('Y-m-d H:i:s');
        $value = Crypt::decrypt($request->hash);
        $user = User::where('authenticable_id', $value)->first();
        $user->email_verified_at = $verified;
        $user->update();
        return view('administrator.peserta.confirmation');
    }
}
