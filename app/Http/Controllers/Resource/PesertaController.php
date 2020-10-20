<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Peserta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->get('q');
        $peserta = Peserta::where(function (Builder $query) use ($keyword) {
            return $query->where('nama', 'like', "%$keyword%")
                ->orWhereHas('authenticable', function (Builder $query) use ($keyword) {
                    return $query->where('email', $keyword);
                });
        })->whereDoesntHave('pkl')->get(['id', 'nama']);

        return response()->json([
            'data' => $peserta,
            'message' => 'success'
        ]);
    }

    public function show(Peserta $peserta)
    {
        $peserta->load('authenticable');

        return view('partials.peserta-info', compact('peserta'));
    }
}
