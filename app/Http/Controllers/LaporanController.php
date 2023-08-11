<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function kelas(AuthService $authService)
    {
        $tahun = Mahasiswa::select('tahun_angkatan')->distinct();
        $kelas = Kelas::all();

        if ($authService->currentUserIsKaprodi()) {
            $kaprodi = $authService->currentUserGuardInstance()->user();
            $prodi = Prodi::where('id_user', $kaprodi->id_user)->first();
            $tahun = $tahun->where('id_prodi', $prodi->id_prodi);
            $kelas = $prodi->kelas;
        }

        $tahun = array_map(
            fn ($item) => $item['tahun_angkatan'], $tahun->get()->toArray()
        );

        return view('admins.laporan.kelas', compact('kelas', 'tahun'));
    }

    public function print_kelas(Request $request, AuthService $authService)
    {
        $request->validate(['id_kelas' => 'required', 'tahun' => 'required']);

        $kelas = Kelas::find($request->id_kelas);
        $tahun = $request->tahun;
        $mahasiswa = Mahasiswa::whereHas('kelas', fn ($query) => $query->where('id_kelas', $request->id_kelas))
            ->where('tahun_angkatan',  $request->tahun)
            ->get();

        $pdf = Pdf::loadView('pdf.kelas', compact('mahasiswa', 'kelas', 'tahun'));
        $pdf = $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function mahasiswa_bimbingan(AuthService $authService)
    {
        $title = 'Mahasiswa Bimbingan';
        $mahasiswa = Mahasiswa::whereHas('bimbingan');
        if ($authService->currentUserIsKaprodi()) {
            $kaprodi = $authService->currentUserGuardInstance()->user();
            $prodi = Prodi::where('id_user', $kaprodi->id_user)->first();
            $mahasiswa = $mahasiswa->whereHas(
                'kelas', fn ($query) => $query->where('id_prodi', $prodi->id_prodi)
            );
        }
        $mahasiswa = $mahasiswa->get();

        return view('admins.laporan.mahasiswa-bimbingan', compact('title', 'mahasiswa'));
    }

    public function print_mahasiswa_bimbingan(AuthService $authService)
    {
        $title = 'MAHASISWA BIMBINGAN';
        $mahasiswa = Mahasiswa::whereHas('bimbingan');
        if ($authService->currentUserIsKaprodi()) {
            $kaprodi = $authService->currentUserGuardInstance()->user();
            $prodi = Prodi::where('id_user', $kaprodi->id_user)->first();
            $mahasiswa = $mahasiswa->whereHas(
                'kelas', fn ($query) => $query->where('id_prodi', $prodi->id_prodi)
            );
        }
        $mahasiswa = $mahasiswa->get();

        $pdf = Pdf::loadView('pdf.mahasiswa-bimbingan', compact('title', 'mahasiswa'));
        $pdf = $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function mahasiswa_tidak_bimbingan(AuthService $authService)
    {
        $title = 'Mahasiswa Tidak Bimbingan';
        $mahasiswa = Mahasiswa::doesntHave('bimbingan');
        if ($authService->currentUserIsKaprodi()) {
            $kaprodi = $authService->currentUserGuardInstance()->user();
            $prodi = Prodi::where('id_user', $kaprodi->id_user)->first();
            $mahasiswa = $mahasiswa->whereHas(
                'kelas', fn ($query) => $query->where('id_prodi', $prodi->id_prodi)
            );
        }
        $mahasiswa = $mahasiswa->get();

        return view('admins.laporan.mahasiswa-bimbingan', compact('title', 'mahasiswa'));
    }

    public function print_mahasiswa_tidak_bimbingan(AuthService $authService)
    {
        $title = 'MAHASISWA TIDAK BIMBINGAN';
        $mahasiswa = Mahasiswa::doesntHave('bimbingan');
        if ($authService->currentUserIsKaprodi()) {
            $kaprodi = $authService->currentUserGuardInstance()->user();
            $prodi = Prodi::where('id_user', $kaprodi->id_user)->first();
            $mahasiswa = $mahasiswa->whereHas(
                'kelas', fn ($query) => $query->where('id_prodi', $prodi->id_prodi)
            );
        }
        $mahasiswa = $mahasiswa->get();

        $pdf = Pdf::loadView('pdf.mahasiswa-bimbingan', compact('title', 'mahasiswa'));
        $pdf = $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
