<?php

namespace App\Http\Controllers;

use App\Rules\ValidatePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChangePasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        Session::flash('failedChangePassword', true);

        $validated = $request->validate([
            'current_password' => ['required', new ValidatePassword],
            'password_baru' => 'required|min:6',
            'konfirmasi_password' => 'required_with:password_baru|same:password_baru|min:6',
        ]);

        auth()->user()->update(['password' => $validated['password_baru']]);

        Session::forget('failedChangePassword');

        Session::flash('success', 'Password Berhasil diubah');

        return redirect()->back();
    }
}
