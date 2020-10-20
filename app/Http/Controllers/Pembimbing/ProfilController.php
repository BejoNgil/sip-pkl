<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pembimbing = $user->authenticable;

        return view('pembimbing.profil', compact('user', 'pembimbing'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:user,email,' . $user['id']
        ]);

        $user->update($validated);
        $user->authenticable->update($validated);

        Session::flash('success', 'Berhasil Mengubah Profil');

        return redirect()->back();
    }
}
