<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Titik;
use App\Models\Garis;
use App\Models\refPolygon;
use App\Models\KoordinatPolygon;

class APIController extends Controller
{
    public function titik() {
        $koordinat = Titik::select('keterangan', 'latitude', 'longitude')->orderBy('id', 'desc')->get();
        return response()->json($koordinat);
    }
    
    public function garis() {
        $koordinat = Garis::select('lat_awal', 'long_awal', 'lat_akhir', 'long_akhir')->orderBy('id', 'desc')->get();
        return response()->json($koordinat);
    }

    public function polygon() {
        $koordinat = refPolygon::with('koordinatPolygon')->get();
        return response()->json($koordinat);
    }
}
