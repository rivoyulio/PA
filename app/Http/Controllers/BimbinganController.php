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
    public function indexdosen(Request $request, AuthService $authService)
    {
        $user = $authService->currentUserGuardInstance()->user();
        $dosen = Dosen::where('id_user', $user->id_user)->first();
        $bimbingans = Bimbingan::whereHas(
            'mahasiswa', fn ($query) => $query->whereHas(
                'kelas', fn ($query) => $query->where('id_dosen', $dosen->id_dosen)
            )
        );

        if ($request->has('mhs_id')) {
            $bimbingans = $bimbingans->where('id_mhs', $request->mhs_id);
        }

        return view('admins.bimbingan.dosenbimbingan', ['bimbingans' => $bimbingans->get()]);
    }

    public function indexmahasiswa(AuthService $authService)
    {
        $mhs = $authService->currentUserGuardInstance()->user();
        $dosen = $mhs->kelas->dosen;

        return view('admins.bimbingan.mahasiswabimbingan', compact('mhs', 'dosen'));
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

    public function indexhistorydetail(AuthService $authService)
    {

    }

    public function indexdetail(BimbinganService $bimbinganService, AuthService $authService)
    {
        $mhs_id = $authService->currentUserGuardInstance()->user()->id_mhs;
        $bimbingans = $bimbinganService->getBimbinganMahasiswa($mhs_id);
        $mahasiswa = Mahasiswa::where('id_mhs', $mhs_id)->first();

        return view('admins.bimbingan.detailbimbingan', compact('bimbingans', 'mahasiswa'));
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

    public function create(AuthService $authService)
    {
        return view('admins.bimbingan.create', ['mahasiswa' => $authService->currentUserGuardInstance()->user()]);
    }

    public function store(Request $request, AuthService $authService)
    {
        $this->validate_bimbingan($request);
        $this->save_bimbingan($request, new Bimbingan());

        return $this->redirect_to_index($authService, 'Data Bimbingan Berhasil Dibuat');
    }

    public function show(Bimbingan $bimbingan, AuthService $authService)
    {
        return view(
            'admins.bimbingan.edit', ['bimbingan' => $bimbingan, 'mahasiswa' => $authService->currentUserGuardInstance()->user()]
        );
    }

    public function update(Request $request, Bimbingan $bimbingan, AuthService $authService)
    {
        $this->validate_bimbingan($request);
        $this->save_bimbingan($request, $bimbingan);

        return $this->redirect_to_index($authService, 'Data Bimbingan Berhasil Diubah');
    }

    public function destroy(Bimbingan $bimbingan, AuthService $authService)
    {
        $bimbingan->delete();

        return $this->redirect_to_index($authService, 'Data Bimbingan Berhasil Dihapus');
    }

    private function validate_bimbingan(Request $request)
    {
        $request->validate(
            [
                'id_mhs' => 'required',
                'tanggal_bimbingan' => 'required',
                'bimbingan' => 'required',
                'pesan_mhs' => 'required',
            ]
        );
    }

    private function save_bimbingan(Request $request,  Bimbingan $bimbingan)
    {
        $bimbingan->id_mhs = $request->id_mhs;
        $bimbingan->tanggal_bimbingan = $request->tanggal_bimbingan;
        $bimbingan->bimbingan = $request->bimbingan;
        $bimbingan->pesan_mhs = $request->pesan_mhs;
        $bimbingan->pesan_dosen = $request->pesan_dosen;
        $bimbingan->save();
    }

    private function redirect_to_index(AuthService $authService, $message)
    {
        if ($authService->currentUserIsDosen()) {
            return redirect('/dosen/bimbingan/')->withSuccess($message);
        }

        return redirect('/mahasiswa/bimbingan/')->withSuccess($message);
    }
}
