<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Models\Pelanggaran;
use App\Models\Sp;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SpController extends Controller
{
    public function index(AuthService $authService)
    {
        if ($authService->currentUserIsAdmin()) {
            return view('admins.sp.index', ['sps' => Sp::all()]);
        }

        return view('admins.sp.index-public', ['pelanggaran' => $this->get_readonly_sp($authService)]);
    }

    public function print(AuthService $authService)
    {
        $pelanggaran = $this->get_readonly_sp($authService);

        $pdf = Pdf::loadView('pdf.sp', compact('pelanggaran'));
        $pdf = $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function create()
    {
        return view('admins.sp.create');
    }

    public function store(Request $request)
    {
        $this->validate_sp($request);
        $this->save_sp($request, new Sp());

        return redirect('/sp')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Sp $sp)
    {
        return view('admins.sp.edit', compact('sp'));
    }

    public function update(Request $request, Sp $sp)
    {
        $this->validate_sp($request);
        $this->save_sp($request, $sp);

        return redirect('/sp')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(Sp $sp)
    {
        $sp->delete();
        return redirect('/sp')->with('success', 'Data berhasil dihapus!');
    }

    private function get_readonly_sp(AuthService $authService)
    {
        $current_user = $authService->currentUserGuardInstance()->user();

        if ($authService->currentUserGuard() == 'web') {
            if ($authService->currentUserIsAdmin()) $pelanggaran = Pelanggaran::get();

            if ($authService->currentUserIsDosen()) {
                $pelanggaran = Pelanggaran::whereHas(
                    'mahasiswa.kelas.dosen', fn ($query) => $query->where('id_user', $current_user->id_user)
                )->get();
            }

            if ($authService->currentUserIsKaprodi()) {
                $pelanggaran = Pelanggaran::whereHas(
                    'mahasiswa.kelas.prodi', fn ($query) => $query->where('id_user', $current_user->id_user)
                )->get();
            }
        }

        if ($authService->currentUserGuard() == 'mahasiswa') {
            $pelanggaran = Pelanggaran::where('id_mhs', $current_user->id_mhs)->get();
        }

        return $pelanggaran;
    }

    private function save_sp(Request $request, Sp $sp)
    {
        $sp->nama_sp = $request->sp_name;
        $sp->save();
    }

    private function validate_sp(Request $request)
    {
        $rules = ['sp_name' => 'required'];
        $messages = ['sp_name.required' => 'Nama SP harus diisi'];

        $request->validate($rules, $messages);
    }
}
