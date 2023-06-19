<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use App\Models\Satpen;

class OperatorController extends Controller
{
    public function dashboardPage() {
        return view('myprofile.profile');
    }
    public function mySatpenPage() {
        try {
            $satpenProfile = Satpen::with(['kategori', 'provinsi', 'kabupaten', 'jenjang', 'timeline'])
                ->where('id_user', '=', auth()->user()->id_user)
                ->first();

            return view('satpen.satpen', compact('satpenProfile'));

        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function editSatpenPage() {
        try {
            $satpenProfile = Satpen::where('id_user', '=', auth()->user()->id_user)->first();

            if ($satpenProfile->status != 'revisi') return redirect()->back()
                ->with('error', 'Status satpen bukan revisi');

            $kabupaten = Kabupaten::orderBy('id_kab')->get();
            $propinsi = Provinsi::orderBy('id_prov')->get();
            $jenjang = Jenjang::orderBy('id_jenjang')->get();

            return view('satpen.revisi', compact('satpenProfile', 'jenjang', 'propinsi', 'kabupaten'));

        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function underConstruction() {
        return view('template.construction');
    }


}