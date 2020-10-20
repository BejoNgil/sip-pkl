<?php

namespace App\Http\Controllers;

use App\Pembimbing;
use App\PermasalahanKerja;
use App\PKL;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stats = [];

        $user = auth()->user();
        $user->load(['authenticable']);

        if ($user->role === 'pembimbing') {
            $stats['peserta_count'] = PKL::where('pembimbing_id', $user->authenticable_id)->count();
            $stats['peserta_active_count'] = PKL::where('pembimbing_id', $user->authenticable_id)
                ->doesntHave('nilai')->count();
            $stats['masalah_count'] = PermasalahanKerja::whereHas('pkl', function (Builder $query) use ($user) {
                return $query->where('pembimbing_id', $user->authenticable_id);
            })->count();
        } else if($user->role === 'admin') {
            $stats['peserta_count'] = PKL::count();
            $stats['peserta_active_count'] = PKL::doesntHave('nilai')->count();
            $stats['masalah_count'] = PermasalahanKerja::count();
            $stats['pembimbing_count'] = Pembimbing::count();
        }

        return view('home', compact('user', 'stats'));
    }
}
