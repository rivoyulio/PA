<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Models\Mahasiswa;
use App\Models\Pelanggaran;
use App\Models\Sp;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PelanggaranController extends Controller
{
    public function index(AuthService $authService)
    {
        return view('admins.pelanggaran.index', ['pelanggaran' => $this->get_pelanggaran($authService)]);
    }

    public function print(AuthService $authService)
    {
        $pelanggaran = $this->get_pelanggaran($authService);

        $pdf = Pdf::loadView('pdf.pelanggaran', compact('pelanggaran'));
        $pdf = $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function create()
    {
        return view('admins.pelanggaran.create', $this->load_relation());
    }

    public function store(Request $request)
    {
        $this->validate_pelanggaran($request);
        $this->save_pelanggaran($request, new Pelanggaran());

        return redirect('/pelanggaran')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Pelanggaran $pelanggaran)
    {
        $data = compact('pelanggaran');
        $data = array_merge($data, $this->load_relation());

        return view('admins.pelanggaran.edit', $data);
    }

    public function update(Request $request, Pelanggaran $pelanggaran)
    {
        $this->validate_pelanggaran($request);
        $this->save_pelanggaran($request, $pelanggaran);

        return redirect('/pelanggaran')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(Pelanggaran $pelanggaran)
    {
        $pelanggaran->delete();
        return redirect('/pelanggaran')->with('success', 'Data berhasil dihapus!');
    }

    private function get_pelanggaran(AuthService $authService)
    {
        $current_guard = $authService->currentUserGuard();
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

    private function save_pelanggaran(Request $request, Pelanggaran $pelanggaran)
    {
        $pelanggaran->id_sp = $request->id_sp;
        $pelanggaran->pelanggaran = $request->pelanggaran;
        $pelanggaran->id_mhs = $request->id_mhs;
        $pelanggaran->save();
    }

    private function load_relation()
    {
        $sps = Sp::all();
        $mahasiswas = Mahasiswa::all();

        return compact('sps', 'mahasiswas');
    }

    private function validate_pelanggaran(Request $request)
    {
        $rules = [
            'id_sp' => 'required',
            'id_mhs' => 'required'
        ];

        $messages = [
            'id_sp.required' => 'ID SP harus diisi',
            'id_mhs.required' => 'ID Mahasiswa harus diisi'
        ];

        $request->validate($rules, $messages);
    }
}
