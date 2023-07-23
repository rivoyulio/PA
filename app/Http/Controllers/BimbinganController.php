<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Kelas;
use App\Models\Dosen;
use Illuminate\Http\Request;
use PDF;

class BimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexdosen()
    {
        $bimbingans = Bimbingan::with('mahasiswa');

        return view('admins.bimbingan.dosenbimbingan',[
            'bimbingans' => $bimbingans->paginate(5)
        ]);
    }

    public function indexmahasiswa()
    {
        return view('admins.bimbingan.mahasiswabimbingan',[
            'bimbingans' => Bimbingan::all()
        ]);
    }

    public function indexhistory()
    {
        $mahasiswas = Mahasiswa::all();
        $kelass = Kelas::all();
        $prodis = Prodi::all();

        return view('admins.bimbingan.history',compact('mahasiswas', 'kelass', 'prodis'));
    }

    public function indexdetail()
    {
        return view('admins.bimbingan.detail',[
            'bimbingans' => Bimbingan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();

        $title = 'Bimbingan';
        return view('admins.bimbingan.mahasiswabimbingan', compact('mahasiswas', 'dosens', 'title'));
    }

    public function cetak()
    {
        $bimbingans = Bimbingan::all();

        View()->share('bimbingans', $bimbingans);
        $pdf = PDF::loadView('admins.bimbingan.cetak');
        return $pdf->download('Laporan bimbingan.pdf');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());    
        $request->validate([
            'id_mhs' => 'required',
            'tanggal_bimbingan' => 'required',
            'bimbingan' => 'required',
            'pesan_mhs' => 'required',
            // 'pesan_dosen' => 'required',
        ], [
            'id_mhs.required' => '',
            'tanggal_bimbingan.required' => '',
            'bimbingan.required' => '',
            'pesan_mhs.required' => '',
            // 'pesan_dosen.required' => '',
        ]);

        $data = [
            'id_mhs' => $request->id_mhs,
            'tanggal_bimbingan' => $request->tanggal_bimbingan,
            'bimbingan' => $request->bimbingan,
            'pesan_mhs' => $request->pesan_mhs, 
            // 'pesan_dosen' => $request->pesan_dosen, 
        ];

        // dd($data);
        $title = 'Tambah Bimbingan';

        Bimbingan::create($data);
        return redirect('mahasiswabimbingan')->withSuccessMessage('Data Bimbingan Berhasil Ditambahkan', compact('title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bimbingan  $bimbingan
     * @return \Illuminate\Http\Response
     */
    public function show(Bimbingan $bimbingan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bimbingan  $bimbingan
     * @return \Illuminate\Http\Response
     */
    public function edit(Bimbingan $bimbingan)
    {
        $mahasiswas = Mahasiswa::all();

        $data = Bimbingan::where('id_bimbingan', $bimbingan->id_bimbingan)->first();
        return view('admins.bimbingan.edit', compact('mahasiswas', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bimbingan  $bimbingan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bimbingan $bimbingan)
    {
        // dd($request->all());
        $request->validate([
            'id_mhs' => 'required',
            'tanggal_bimbingan' => 'required',
            'bimbingan' => 'required',
            'pesan_mhs' => 'required',
            'pesan_dosen' => 'required',
        ], [
            'id_mhs.required' => '',
            'tanggal_bimbingan.required' => '',
            'bimbingan.required' => '',
            'pesan_mhs.required' => '',
            'pesan_dosen.required' => '',
        ]);

        $data = [
            'id_mhs' => $request->id_mhs,
            'tanggal_bimbingan' => $request->tanggal_bimbingan,
            'bimbingan' => $request->bimbingan,
            'pesan_mhs' => $request->pesan_mhs, 
            'pesan_dosen' => $request->pesan_dosen, 
        ];

        dd($data);
        $title = 'Edit Bimbingan';

        Bimbingan::where('id_bimbingan', $bimbingan->id_bimbingan)->update($data);
        return redirect('dosenbimbingan')->withSuccessMessage('Data Bimbingan Berhasil Diubah', compact('title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bimbingan  $bimbingan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bimbingan $bimbingan)
    {
        {
            $data = Bimbingan::where('id_bimbingan', $bimbingan->id_bimbingan)->first();
            Bimbingan::where('id_bimbingan', $bimbingan->id_bimbingan)->delete();
            return redirect('dosenbimbingan')->withSuccessMessage('Data Bimbingan Berhasil Dihapus');
        }
    }
}
