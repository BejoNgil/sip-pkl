<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $admin = $user->authenticable;

        return view('administrator.profil', compact('user', 'admin'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:user,email,' . $user['id'],
            'divisi' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'sometimes|nullable',
            'telepon' => 'sometimes|nullable|numeric'
        ]);

        if($validated['password'] == null) unset($validated['password']);

        $user->update($validated);
        $user->authenticable->update($validated);

        Session::flash('success', 'Berhasil Mengubah Profil');

        return redirect()->back();
    }
}
