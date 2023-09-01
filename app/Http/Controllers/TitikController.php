<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Titik;

class TitikController extends Controller
{
    public function index(){
        $data = Titik::orderBy('id', 'desc')->get();
        // dd($data[0]['keterangan']);
        return view('titik', compact('data'));
    }

    public function tambah(Request $request) {
        $request->validate([
            'keterangan' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $tambah = Titik::create([
            'keterangan' => $request->keterangan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        if ($tambah) {
            return redirect()->route('titik')->with('success', 'Koordinat berhasil ditambahkan.');
        } else {
            return redirect()->route('titik')->with('error', 'Koordinat gagal ditambahkan.');
        }
    }

    public function update(Request $request, $id) {
        // dd($request);
        $request->validate([
            'keterangan' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $edit = Titik::where('id', $id)->update([
            'keterangan' => $request->keterangan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        if ($edit) {
            return redirect()->route('titik')->with('success', 'Koordinat berhasil disimpan.');
        } else {
            return redirect()->route('titik')->with('error', 'Koordinat gagal disimpan.');
        }
    }

    public function destroy($id) {
        $hapus = Titik::where('id', $id)->delete();

        if ($hapus) {
            return redirect()->route('titik')->with('success', 'Koordinat berhasil dihapus.');
        } else {
            return redirect()->route('titik')->with('error', 'Koordinat gagal dihapus.');
        }
    }
}
