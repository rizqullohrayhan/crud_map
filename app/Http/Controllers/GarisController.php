<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Garis;

class GarisController extends Controller
{
    public function index(){
        $data = Garis::orderBy('id', 'desc')->get();
        return view('garis', compact('data'));
    }

    public function tambah(Request $request) {
        $validator = $request->validate([
            'keterangan' => 'required|string',
            'lat_awal' => 'required|numeric',
            'long_awal' => 'required|numeric',
            'lat_akhir' => 'required|numeric',
            'long_akhir' => 'required|numeric',
        ]);

        $tambah = Garis::create([
            'keterangan' => $request->keterangan,
            'lat_awal' => $request->lat_awal,
            'long_awal' => $request->long_awal,
            'lat_akhir' => $request->lat_akhir,
            'long_akhir' => $request->long_akhir,
        ]);

        if ($tambah) {
            return redirect()->route('garis')->with('success', 'Garis berhasil ditambah');
        } else {
            return redirect()->route('garis')->with('error', $validator);
        }
    }

    public function update(Request $request, $id) {
        $validator = $request->validate([
            'keterangan' => 'required|string',
            'lat_awal' => 'required|numeric',
            'long_awal' => 'required|numeric',
            'lat_akhir' => 'required|numeric',
            'long_akhir' => 'required|numeric',
        ]);

        $edit = Garis::where('id', $id)->update([
            'keterangan' => $request->keterangan,
            'lat_awal' => $request->lat_awal,
            'long_awal' => $request->long_awal,
            'lat_akhir' => $request->lat_akhir,
            'long_akhir' => $request->long_akhir,
        ]);

        if ($edit) {
            return redirect()->route('garis')->with('success', 'Garis berhasil diedit');
        } else {
            return redirect()->route('garis')->with('error', $validator);
        }
    }

    public function destroy($id) {
        $hapus = Garis::where('id', $id)->delete();

        if ($hapus) {
            return redirect()->route('garis')->with('success', 'garis berhasil dihapus.');
        } else {
            return redirect()->route('garis')->with('error', 'garis gagal dihapus.');
        }
    }
}
