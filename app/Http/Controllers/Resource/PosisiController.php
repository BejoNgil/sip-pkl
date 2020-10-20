<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Pembimbing;
use App\Posisi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PosisiController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->get('q');
        $posisi = Posisi::where('nama', 'like', "%$keyword%")
            ->get(['id','nama']);

        return response()->json([
            'data' => $posisi,
            'message' => 'success'
        ]);
    }
}
