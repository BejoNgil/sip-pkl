<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Pembimbing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->get('q');
        $pembimbing = Pembimbing::where('nama', 'like', "%$keyword%")
            ->orWhereHas('authenticable', function (Builder $query) use ($keyword) {
                return $query->where('email', $keyword);
            })
            ->get(['id','nama']);

        return response()->json([
            'data' => $pembimbing,
            'message' => 'success'
        ]);
    }
}
