<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Pelanggaran;
use App\Models\Prodi;
use App\Models\Sp;
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

    public function get_kelas(AuthService $authService)
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

        return $kelas;
        return $tahun;
    }

    public function pelanggaran(AuthService $authService)
    {
        $title = 'Pelanggaran';

        $tahun = Mahasiswa::select('tahun_angkatan')->distinct()->get();
        $pelanggaran = Pelanggaran::with('komdis')->get();

        $kelas = $this->get_kelas($authService);
        
        // dd($tahun);

        return view('admins.laporan.pelanggaran', compact('pelanggaran', 'title', 'kelas', 'tahun'));
    }

    public function print_pelanggaran(AuthService $authService, Request $request)
    {
        $kelas = $request->id_kelas;
        $tahun = $request->tahun;

        $mahasiswa = Mahasiswa::whereHas('pelanggaran');
        if ($authService->currentUserIsKaprodi()) {
            $kaprodi = $authService->currentUserGuardInstance()->user();
            $prodi = Prodi::where('id_user', $kaprodi->id_user)->first();
            $mahasiswa = $mahasiswa->whereHas(
                'kelas', fn ($query) => $query->where('id_prodi', $prodi->id_prodi)
            );
        }

        if($kelas) {
            $mahasiswa->where('id_kelas', $kelas);
        }
        if($tahun) {
            $tahunArray = json_decode($tahun, true);

            if(!empty($tahunArray)){
                $mahasiswa->where('tahun_angkatan', $tahunArray['tahun_angkatan']);
            }
        }
        $mahasiswa = $mahasiswa->get();
        // dd($mahasiswa);

        $pdf = Pdf::loadView('pdf.laporan-pelanggaran', compact('mahasiswa'));
        $pdf = $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function sp(AuthService $authService)
    {
        $title = 'SP';

        $tahun = Mahasiswa::select('tahun_angkatan')->distinct()->get();
        $sp = Sp::with('semester')->get();

        $kelas = $this->get_kelas($authService);
        
        // dd($tahun);

        return view('admins.laporan.sp', compact('sp', 'title', 'kelas', 'tahun'));
    }

    public function print_sp(AuthService $authService, Request $request)
    {
        $kelas = $request->id_kelas;
        $tahun = $request->tahun;
        
        $mahasiswa = Mahasiswa::whereHas('sp');
        if ($authService->currentUserIsKaprodi()) {
            $kaprodi = $authService->currentUserGuardInstance()->user();
            $prodi = Prodi::where('id_user', $kaprodi->id_user)->first();
            $mahasiswa = $mahasiswa->whereHas(
                'kelas', fn ($query) => $query->where('id_prodi', $prodi->id_prodi)
            );
        }

        if($kelas) {
            $mahasiswa->where('id_kelas', $kelas);
        }
        if($tahun) {
            $tahunArray = json_decode($tahun, true);

            if(!empty($tahunArray)){
                $mahasiswa->where('tahun_angkatan', $tahunArray['tahun_angkatan']);
            }
        }
        $mahasiswa = $mahasiswa->get();
        // dd($mahasiswa);

        $pdf = Pdf::loadView('pdf.laporan-sp', compact('mahasiswa'));
        $pdf = $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

}
