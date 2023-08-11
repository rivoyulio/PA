<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KaprodiController extends Controller
{
    public function profile(AuthService $authService)
    {
        $kaprodi = $authService->currentUserGuardInstance()->user();
        $prodi = Prodi::where('id_user', $kaprodi->id_user)->first();
        $kelas = Kelas::where('id_prodi', $prodi->id_prodi)->first();

        return view('admins.kaprodi.profile', compact('kaprodi', 'prodi', 'kelas'));
    }
}
