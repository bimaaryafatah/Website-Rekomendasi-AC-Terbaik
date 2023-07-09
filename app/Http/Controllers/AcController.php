<?php


namespace App\Http\Controllers;

use App\Models\historiAc;
use App\Models\Ac;
use Illuminate\Http\Request;

class AcController extends Controller
{
    public function index()
    {
        $acs = Ac::all();
        return view('acs.index', compact('acs'));
    }

    public function create()
    {
        return view('acs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'daya' => 'required',
            'konsumsi_listrik' => 'required',
            'tingkat_kebisingan' => 'required',
            'garansi' => 'required',
        ]);

        Ac::create($request->all());

        return redirect('/ac');
        // ->with('success', 'Ac created successfully.')
    }

    public function edit($id)
    {
        $ac = Ac::find($id);

        return view('acs.edit', compact('ac'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'daya' => 'required',
            'konsumsi_listrik' => 'required',
            'tingkat_kebisingan' => 'required',
            'garansi' => 'required',
        ]);

        $acs = Ac::find($id);
        $acs->update($request->all());

        return redirect('/ac');
    }

    public function destroy($id)
    {
        $acs = Ac::find($id);
        $acs->delete();

        return redirect('/ac');
    }

    public function showForm()
    {
        return view('acs.formbobot');
    }

    public function spk(Request $request)
    {
        // Mengambil inputan bobot dari form
        $hargaBobot = $request->input('harga_bobot');
        $dayaBobot = $request->input('daya_bobot');
        $konsumsilistrikBobot = $request->input('konsumsi_listrik_bobot');
        $tingkatkebisinganBobot = $request->input('tingkat_kebisingan_bobot');
        $garansiBobot = $request->input('garansi_bobot');

        // Validasi jumlah bobot
        $totalBobot = $hargaBobot + $dayaBobot + $konsumsilistrikBobot + $tingkatkebisinganBobot + $garansiBobot;
        if ($totalBobot != 1.0) {
            // Jumlah bobot tidak valid, berikan pesan error atau lakukan tindakan sesuai kebutuhan
            return redirect()->back()->with('error', 'Jumlah bobot harus = 1.0');
        }


        // Melakukan perhitungan Weighted Product
        $acs = Ac::all();
        foreach ($acs as $ac) {
            // Menghitung pangkat kriteria berdasarkan bobot
            $hargaPangkat = pow($ac->harga, -$hargaBobot);
            $dayaPangkat = pow($ac->daya, $dayaBobot);
            $konsumsilistrikPangkat = pow($ac->konsumsi_listrik, -$konsumsilistrikBobot);
            $tingkatkebisinganPangkat = pow($ac->tingkat_kebisingan, -$tingkatkebisinganBobot);
            $garansiPangkat = pow($ac->garansi, $garansiBobot);

            // Menghitung Vector S
            $vectorS = $hargaPangkat * $dayaPangkat * $konsumsilistrikPangkat * $tingkatkebisinganPangkat * $garansiPangkat;
            $ac->score = $vectorS;
        }

        // Menghitung hasil akhir (normalisasi)
        $totalScore = $acs->sum('score');
        foreach ($acs as $ac) {
            $ac->result = $ac->score / $totalScore;
        }

        // Mengurutkan konsol berdasarkan skor tertinggi
        $acs = $acs->sortByDesc('result');
        $highestResult = $acs->first()->result;

        return view('acs.spk', compact('acs', 'highestResult'));

        // // Menyimpan data hasil perhitungan pengguna ke database
        // foreach ($acs as $ac) {
        //     $historiAc = new historiAc();
        //     $historiAc->harga_bobot = $hargaBobot;
        //     $historiAc->daya_bobot = $dayaBobot;
        //     $historiAc->konsumsi_listrik_bobot = $konsumsilistrikBobot;
        //     $historiAc->tingkat_kebisingan_bobot = $tingkatkebisinganBobot;
        //     $historiAc->garansi_bobot = $garansiBobot;

        //     $ac = Ac::where('id', $ac->id)->first();
        //     if($ac){
        //         $historiAc->nama_barang = $ac->nama;
        //     }
        //     $historiAc->hasil = $ac->hasil;
        //     $historiAc->save();
        // }
    }
    // public function histori(){
    //     $historiAc = historiAc::all();

    //     return view('backend.histori', compact('historiAc'));
    // }
}
