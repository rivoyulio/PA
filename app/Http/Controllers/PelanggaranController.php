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
    public function index(AuthService $authService, Request $request)
    {
        $tahun = $request->tahun;
        $semester = $request->semester;

        $pelanggaran = $this->get_pelanggaran($authService, $tahun, $semester);
        $semester_list = Pelanggaran::selectRaw('semester')->distinct()->whereNotNull('semester')->get();
        $tahun_list = Mahasiswa::select('tahun_angkatan as tahun')->distinct()->whereNotNull('tahun_angkatan')->get();

        $data = compact(
            'pelanggaran',
            'tahun',
            'semester',
            'tahun_list',
            'semester_list'
        );

        return view('admins.pelanggaran.index', $data);
    }

    public function print(AuthService $authService, Request $request)
    {
        $pelanggaran = $this->get_pelanggaran($authService, $request->tahun, $request->semester);

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

    private function get_pelanggaran(AuthService $authService, $tahun = null, $semester = null)
    {
        $current_user = $authService->currentUserGuardInstance()->user();

        $pelanggaran = Pelanggaran::with('mahasiswa');

        if ($authService->currentUserGuard() == 'web') {
            if ($authService->currentUserIsDosen()) {
                $pelanggaran = Pelanggaran::whereHas(
                    'mahasiswa.kelas.dosen', fn ($query) => $query->where('id_user', $current_user->id_user)
                );
            }

            if ($authService->currentUserIsKaprodi()) {
                $pelanggaran = Pelanggaran::whereHas(
                    'mahasiswa.kelas.prodi', fn ($query) => $query->where('id_user', $current_user->id_user)
                );
            }
        }

        if ($authService->currentUserGuard() == 'mahasiswa') {
            $pelanggaran = Pelanggaran::where('id_mhs', $current_user->id_mhs);
        }

        if ($semester) $pelanggaran = $pelanggaran->where('semester', $semester);
        if ($tahun) $pelanggaran = $pelanggaran->whereHas(
            'mahasiswa', fn ($query) => $query->where('tahun_angkatan', $tahun)
        );

        return $pelanggaran->get();
    }

    private function save_pelanggaran(Request $request, Pelanggaran $pelanggaran)
    {
        $pelanggaran->id_sp = $request->id_sp;
        $pelanggaran->pelanggaran = $request->pelanggaran;
        $pelanggaran->id_mhs = $request->id_mhs;
        $pelanggaran->tanggal = $request->tanggal;
        $pelanggaran->semester = $request->semester;

        if ($request->hasFile('surat')) {
            if ($pelanggaran->surat) unlink(public_path('surat/' . $pelanggaran->surat));
            $surat = $request->file('surat');
            $surat_name = time() . '_' . $surat->getClientOriginalName();
            $surat->move(public_path('surat'), $surat_name);

            $pelanggaran->surat = $surat_name;
        }

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
            'id_mhs' => 'required',
            'pelanggaran' => 'required',
            'surat' => 'nullable|mimes:pdf|max:5120', // max 5MB
            'tanggal' => 'required',
            'semester' => 'required'
        ];

        $messages = [
            'id_sp.required' => 'ID SP harus diisi',
            'id_mhs.required' => 'ID Mahasiswa harus diisi',
            'pelanggaran.required' => 'Pelanggaran harus diisi',
            'surat.mimes' => 'Surat harus berupa file PDF',
            'surat.max' => 'Ukuran file maksimal 5MB',
            'tanggal.required' => 'Tanggal harus diisi',
            'semester.required' => 'Semester harus diisi'
        ];

        $request->validate($rules, $messages);
    }
}
