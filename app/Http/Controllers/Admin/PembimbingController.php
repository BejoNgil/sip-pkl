<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pembimbing = Pembimbing::with('pkl', 'authenticable')->get();

        return view('administrator.pembimbing.index', compact('pembimbing'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Session::flash('showCreateModal', true);

        $validated = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:user,email',
            'divisi' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'password' => 'required|min:6'
        ]);

        $pembimbing = Pembimbing::create($validated);

        $pembimbing->authenticable()->create($validated + ['email_verified_at' => now()]);

        Session::forget('showCreateModal');
        Session::flash('success', 'Berhasil Menambahkan Pembimbing');

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pembimbing  $pembimbing
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Pembimbing $pembimbing)
    {
        Session::flash('showModal', $pembimbing['id']);

        $validated = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:user,email,' . $pembimbing['authenticable']['id'],
            'divisi' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'password' => 'sometimes|nullable|min:6'
        ]);

        if($validated['password'] == null) unset($validated['password']);

        $pembimbing->update($validated);
        $pembimbing->authenticable->update($validated);

        Session::forget('showModal');
        Session::flash('success', 'Berhasil Mengubah Data Pembimbing');

        return redirect()->back();
    }


    public function destroy(Pembimbing $pembimbing)
    {
        $pembimbing->authenticable()->delete();
        $pembimbing->delete();

        Session::flash('success', 'Berhasil Menghapus Pembimbing');

        return route('pembimbing.index');
    }
}
