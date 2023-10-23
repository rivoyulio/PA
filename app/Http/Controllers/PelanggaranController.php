<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelanggaranRequest;
use App\Http\Services\AuthService;
use App\Models\Dosen;
use App\Models\komdis;
use App\Models\Mahasiswa;
use App\Models\Pelanggaran;
use App\Models\PelanggaranCategory;
use App\Models\Semester;
use App\Models\Sp;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PelanggaranController extends Controller
{
    public function index(AuthService $authService, Request $request)
    {
        $tahun = $request->tahun;
        $semester = $request->semester;

        $pelanggaran = $this->get_pelanggaran($authService, $tahun, $semester);
        $semester_list = Pelanggaran::with('semester')->selectRaw('id_semester')->distinct()->whereNotNull('id_semester')->get();
        
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
        $data = $this->save_pelanggaran($request, new Pelanggaran());
        return redirect('/pelanggaran')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Pelanggaran $pelanggaran)
    {
        $data = compact('pelanggaran');
        $data = array_merge($data, $this->load_relation());
        // dd($data);
        return view('admins.pelanggaran.edit', $data);
    }

    public function update(PelanggaranRequest $request, $id)
    {
        $data = $request->all();
        $pelanggaran = Pelanggaran::with('mahasiswa')->findOrFail($id);

        $pelanggaran->update($data);

        // dd($data);

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

        $pelanggaran = Pelanggaran::with('mahasiswa', 'semester', 'komdis', 'kategori');
        // dd($pelanggaran);
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

        if ($semester) $pelanggaran = $pelanggaran->where('id_semester', $semester);
        if ($tahun) $pelanggaran = $pelanggaran->whereHas(
            'mahasiswa', fn ($query) => $query->where('tahun_angkatan', $tahun)
        );

        return $pelanggaran->get();

    }

    private function save_pelanggaran(Request $request, Pelanggaran $pelanggaran)
    {
        $pelanggaran->id_kategori = $request->id_kategori;
        $pelanggaran->id_mhs = $request->id_mhs;
        $pelanggaran->tanggal = $request->tanggal;
        $pelanggaran->id_semester = $request->id_semester;
        $pelanggaran->deskripsi = $request->deskripsi;
        $pelanggaran->id_komdis = $request->id_komdis;
        // if ($request->hasFile('surat')) {
        //     if ($pelanggaran->surat) unlink(public_path('surat/' . $pelanggaran->surat));
        //     $surat = $request->file('surat');
        //     $surat_name = time() . '_' . $surat->getClientOriginalName();
        //     $surat->move(public_path('surat'), $surat_name);

        //     $pelanggaran->surat = $surat_name;
        // }

        $pelanggaran->save();
    }

    private function load_relation()
    {
        $komdis = komdis::all();
        $semesters = Semester::all();
        // $mahasiswas = Mahasiswa::select('nama_mhs')->distinct()->get();
        $mahasiswas = Mahasiswa::all();
        $kategori = PelanggaranCategory::all();

        return compact('mahasiswas', 'semesters', 'komdis', 'kategori');
    }

    private function validate_pelanggaran(Request $request)
    {
        $rules = [
            'id_mhs' => 'required|exists:mahasiswas,id_mhs',
            'id_kategori' => 'required|exists:kategori_pelanggaran,id',
            'tanggal' => 'required',
            'id_semester' => 'required|exists:semester,id_semester',
            'deskripsi' => 'required',
            'id_komdis' => 'required|exists:komdis,id_komdis'
        ];

        $messages = [
            'id_mhs.required' => 'ID Mahasiswa harus diisi',
            'id_kategori.required' => 'Tipe pelanggaran harus diisi',
            'tanggal.required' => 'Tanggal harus diisi',
            'id_semester.required' => 'Semester harus diisi',
            'deskripsi.required' => 'Deskripsi harus diisi',
            'id_komdis.required' => 'Komdis haris diisi'
        ];

        $request->validate($rules, $messages);
    }

    public function tindak_lanjut(AuthService $authService, Request $request)
    {
        $tahun = $request->tahun;
        $semester = $request->semester;

        $current_user = $authService->currentUserGuardInstance()->user();
        $dosen = Dosen::where('id_user', $current_user->id_user)->first();
        $komdis = komdis::with('dosen')->where('id_dosen', $dosen->id_dosen)->first();
        // dd($komdis);
        $pelanggaran = Pelanggaran::with('komdis', 'kategori')->where('id_komdis', $komdis->id_komdis)->get();
        // dd($pelanggaran);
        $semester_list = Pelanggaran::with('semester')->selectRaw('id_semester')->distinct()->whereNotNull('id_semester')->get();
        
        $tahun_list = Mahasiswa::select('tahun_angkatan as tahun')->distinct()->whereNotNull('tahun_angkatan')->get();
        
        if ($semester) $pelanggaran = $pelanggaran->where('id_semester', $semester);
        if ($tahun) $pelanggaran = $pelanggaran->whereHas(
            'mahasiswa', fn ($query) => $query->where('tahun_angkatan', $tahun)
        );

        return view('admins.pelanggaran.pelanggaran-komdis', compact('pelanggaran', 'tahun', 'semester', 'semester_list', 'tahun_list'));
    }
}