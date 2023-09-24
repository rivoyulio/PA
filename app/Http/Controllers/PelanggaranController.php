<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelanggaranRequest;
use App\Http\Services\AuthService;
use App\Models\Mahasiswa;
use App\Models\Pelanggaran;
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
        $this->save_pelanggaran($request, new Pelanggaran());

        return redirect('/pelanggaran')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Pelanggaran $pelanggaran)
    {
        $data = compact('pelanggaran');
        $data = array_merge($data, $this->load_relation());

        return view('admins.pelanggaran.edit', $data);
    }

    public function update(PelanggaranRequest $request, $id)
    {
        $data = $request->all();
        $pelanggaran = Pelanggaran::with('mahasiswa')->findOrFail($id);
        $existing = $pelanggaran->waktu_keterlambatan;
        $newtime = (int)$data['waktu_keterlambatan'];
        
        //akan berjalan ketika semester masih sama
        if($pelanggaran->id_semester == $data['id_semester']){
            $totaltime = $existing += $newtime;
            $data['waktu_keterlambatan'] = $totaltime;
        } else {
            $data['waktu_keterlambatan'] = $newtime;
        }

        $pelanggaran->update($data);

        // dd($data);
        if($totaltime >= 15)
        {
            $pelanggaran->status = 'sp1';
            $pelanggaran->save();

            $pdfPath = $this->generate_sp1($id);
            $pelanggaran->surat = $pdfPath;
            $pelanggaran->save();
        } 
        elseif ($totaltime >= 30){
            $pelanggaran->status = 'sp2';
        }
        elseif ($totaltime >= 45){
            $pelanggaran->status = 'sp3';
        }

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

        $pelanggaran = Pelanggaran::with('mahasiswa', 'semester');

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
        $pelanggaran->pelanggaran = $request->pelanggaran;
        $pelanggaran->id_mhs = $request->id_mhs;
        $pelanggaran->tanggal = $request->tanggal;
        $pelanggaran->id_semester = $request->id_semester;
        $pelanggaran->waktu_keterlambatan = $request->waktu_keterlambatan;

        if($request->waktu_keterlambatan >= 15){
            $pelanggaran->status = 'sp1';
        } elseif ($request->waktu_keterlambatan >= 30){
            $pelanggaran->status = 'sp2';
        } elseif ($request->waktu_keterlambatan >= 45){
            $pelanggaran->status = 'sp3';
        }

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
        $semesters = Semester::all();
        $mahasiswas = Mahasiswa::all();

        return compact('mahasiswas', 'semesters');
    }

    private function validate_pelanggaran(Request $request)
    {
        $rules = [
            'id_mhs' => 'required|exists:mahasiswas,id_mhs',
            'pelanggaran' => 'required',
            'tanggal' => 'required',
            'id_semester' => 'required|exists:semester,id_semester',
            'waktu_keterlambatan' => 'required|numeric'
        ];

        $messages = [
            'id_mhs.required' => 'ID Mahasiswa harus diisi',
            'pelanggaran.required' => 'Pelanggaran harus diisi',
            'tanggal.required' => 'Tanggal harus diisi',
            'id_semester.required' => 'Semester harus diisi',
            'waktu_keterlambatan.required' => 'Waktu harus diisi'
        ];

        $request->validate($rules, $messages);
    }

    public function generate_sp1($id)
    {
        $pelanggaran = Pelanggaran::findOrFail($id);
        $pdf = Pdf::loadView('pdf.sp', compact('pelanggaran'));
        $pdf = $pdf->setPaper('a4', 'potrait');

        $pdfContent = $pdf->output();

        $pdfPath = 'sp1/'. uniqid() . '.pdf';
        Storage::disk('public')->put($pdfPath, $pdfContent);

        return $pdfPath;
    }

    public function generate_sp3($id)
    {

    }
}
