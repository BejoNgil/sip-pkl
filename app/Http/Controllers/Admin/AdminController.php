<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $admin = Admin::with('authenticable')->get();

        return view('administrator.admin.index', compact('admin'));
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
            'email' => 'required|unique:user,email',
            'password' => 'required|min:6'
        ]);

        $admin = Admin::create($validated);
        $admin->authenticable()->create($validated + ['email_verified_at' => now()]);

        Session::forget('showCreateModal');
        Session::flash('success', 'Berhasil menambahkan admin');

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Admin $admin)
    {
        Session::flash('showModal', $admin['id']);

        $validated = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|unique:user,email,' . $admin['authenticable']['id'],
            'password' => 'sometimes|nullable|min:6'
        ]);

        $admin->update($validated);
        $admin->authenticable->update($validated);

        Session::forget('showModal');
        Session::flash('success', 'Berhasil mengubah data admin');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Admin $admin
     * @return string
     * @throws \Exception
     */
    public function destroy(Admin $admin)
    {
        $admin->authenticable->delete();
        $admin->delete();

        Session::flash('success', 'Berhasil menghapus admin');

        return route('admin.index');
    }
}
