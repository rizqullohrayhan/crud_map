<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\refPolygon;
use App\Models\KoordinatPolygon;

class RefPolygonController extends Controller
{
    public function index() {
        $data = refPolygon::with('KoordinatPolygon')->orderBy('id', 'desc')->get();
        // dd($data);
        return view('polygon', compact('data'));
    }

    public function tambah(Request $request) {
        $validate = $request->validate([
            'keterangan' => 'required|string',
            'lat1' => 'required|numeric',
            'long1' => 'required|numeric',
            'lat2' => 'required|numeric',
            'long2' => 'required|numeric',
            'lat3' => 'required|numeric',
            'long3' => 'required|numeric',
        ]);

        // dd(count($request->all()));
        // dd(var_dump($request));
        $keteranganId = refPolygon::create([
            'keterangan' => $request->keterangan
        ]);

        try {
            $batas = (count($request->all())-1)/2;
            for ($i=1; $i < $batas; $i++) { 
                KoordinatPolygon::create([
                    'refPolygon_id' => $keteranganId->id,
                    'latitude' => $request['lat'.$i],
                    'longitude' => $request['long'.$i],
                ]);
            }
            return redirect()->route('polygon')->with('success', 'Polygon berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->route('polygon')->with('error', $e);
        }

        return redirect()->route('polygon')->with('error', $validate);
    }

    public function updateRefPolygon(Request $request, $id) {
    }

    public function updateKoorPolygon(Request $request, $id) {
        $validator = $request->validate([
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
        ]);

        $update = KoordinatPolygon::where('id', $id)->update([
            'latitude' => $request->lat,
            'longitude' => $request->long,
        ]);

        if ($update) {

        } else {
            return redirect()->back()->withErrors($validator);
        }
        
    }

    public function destroy($id) {
        KoordinatPolygon::where('refPolygon_id', $id)->delete();
        $hapus = refPolygon::where('id', $id)->delete();

        if ($hapus) {
            return redirect()->route('polygon')->with('success', 'Polygon berhasil dihapus');
        } else {
            return redirect()->route('polygon')->with('error', 'Polygon gagal dihapus');
        }
        
    }
}
