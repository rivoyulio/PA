<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Http\Services\BimbinganService;
use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexdosen(AuthService $authService)
    {
        $user = $authService->currentUserGuardInstance()->user();
        $dosen = Dosen::where('id_user', $user->id_user)->first();
        $bimbingans = Bimbingan::whereHas(
            'mahasiswa', fn ($query) => $query->whereHas(
                'kelas', fn ($query) => $query->where('id_dosen', $dosen->id_dosen)
            )
        )->get();

        return view('admins.bimbingan.dosenbimbingan', compact('bimbingans'));
    }

    public function indexmahasiswa()
    {
        return view('admins.bimbingan.mahasiswabimbingan');
    }

    public function indexhistory(AuthService $authService)
    {
        $user = $authService->currentUserGuardInstance()->user();
        $dosen = Dosen::where('id_user', $user->id_user)->first();

        $mahasiswas = Mahasiswa::whereHas(
            'kelas', fn ($query) => $query->where('id_dosen', $dosen->id_dosen)
        )->get();

        return view('admins.bimbingan.history', compact('mahasiswas'));
    }

    public function indexdetail(BimbinganService $bimbinganService, AuthService $authService)
    {
        $mhs_id = $authService->currentUserGuardInstance()->user()->id_mhs;
        $bimbingans = $bimbinganService->getBimbinganMahasiswa($mhs_id);
        $mahasiswa = Mahasiswa::where('id_mhs', $mhs_id)->first();

        return view('admins.bimbingan.detail', compact('bimbingans', 'mahasiswa'));
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

    public function cetak(BimbinganService $bimbinganService, AuthService $authService)
    {
        $mhs_id = $authService->currentUserGuardInstance()->user()->id_mhs;
        $bimbingans = $bimbinganService->getBimbinganMahasiswa($mhs_id);
        $mahasiswa = Mahasiswa::where('id_mhs', $mhs_id)->first();

        $pdf = Pdf::loadView('pdf.bimbingan', compact('bimbingans', 'mahasiswa'));
        $pdf = $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
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
