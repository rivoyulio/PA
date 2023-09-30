<?php

namespace App\Http\Controllers;

use App\Http\Requests\SPRequest;
use App\Http\Services\AuthService;
use App\Models\Mahasiswa;
use App\Models\Pelanggaran;
use App\Models\Semester;
use App\Models\Sp;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class SpController extends Controller
{
    public function index(AuthService $authService, Request $request)
    {
        $tahun = $request->tahun;
        $semester = $request->semester;

        $sp = $this->get_sp($authService, $tahun, $semester);
        $semester_list = Sp::with('semester')->selectRaw('id_semester')->distinct()->whereNotNull('id_semester')->orderBy('id_semester','asc')->get();
        $tahun_list = Mahasiswa::select('tahun_angkatan as tahun')->distinct()->whereNotNull('tahun_angkatan')->get();

        $data = compact(
            'sp',
            'tahun',
            'semester',
            'tahun_list',
            'semester_list'
        );
        if ($authService->currentUserIsAdmin()) {
            return view('admins.sp.index', $data);
        } else {
            return view('admins.sp.index-public', $data);
        }
    }

    public function print(AuthService $authService, Request $request)
    {
        $sp = $this->get_sp($authService, $request->tahun, $request->semester);

        $pdf = Pdf::loadView('pdf.list-sp', compact('sp'));
        $pdf = $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function create()
    {
        $semesters = Semester::all();
        $mahasiswas = Mahasiswa::all();
        return view('admins.sp.create', compact('semesters', 'mahasiswas'));
    }

    public function store(Request $request)
    {
        $this->validate_sp($request);
        $this->save_sp($request, new Sp());
        // dd($data);
        return redirect('/sp')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Sp $sp)
    {
        $semesters = Semester::all();
        return view('admins.sp.edit', compact('sp', 'semesters'));
    }

    public function update(SPRequest $request, $id)
    {
        $data = $request->all();
        $sp = Sp::with('mahasiswa')->findOrFail($id);

        $existing = $sp->alfa;
        $newtime = (int)$data['alfa'];
        $totaltime = 0;

        if($sp->id_semester == $data['id_semester']){
            $totaltime = $existing += $newtime;
            $data['alfa'] = $totaltime;
        } else {
            $data['alfa'] = $newtime;
            $data['status'] = 'baik';
        }

        $sp->update($data);

        if($totaltime >= 15)
        {
            $sp->status = 'sp1';
            $sp->save();

            $pdfPath = $this->generate_sp($id);
            $sp->surat = $pdfPath;
            $sp->save();
        } 
        if ($totaltime >= 30){
            $sp->status = 'sp2';
            $sp->save();

            $pdfPath = $this->generate_sp($id);
            $sp->surat = $pdfPath;
            $sp->save();
        }
        if ($totaltime >= 45){
            $sp->status = 'sp3';
            $sp->save();

            $pdfPath = $this->generate_sp($id);
            $sp->surat = $pdfPath;
            $sp->save();
        }

        return redirect('/sp')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(Sp $sp)
    {
        $sp->delete();
        return redirect('/sp')->with('success', 'Data berhasil dihapus!');
    }

    private function get_sp(AuthService $authService, $tahun = null, $semester = null)
    {
        $current_user = $authService->currentUserGuardInstance()->user();

        $sp = Sp::with('mahasiswa');

        if ($authService->currentUserGuard() == 'web') {
            if ($authService->currentUserIsDosen()) {
                $sp = Sp::whereHas(
                    'mahasiswa.kelas.dosen', fn ($query) => $query->where('id_user', $current_user->id_user)
                );
            }

            if ($authService->currentUserIsKaprodi()) {
                $sp = Sp::whereHas(
                    'mahasiswa.kelas.prodi', fn ($query) => $query->where('id_user', $current_user->id_user)
                );
            }

            if($authService->currentUserIsAdmin()) {
                $sp = Sp::with('semester', 'mahasiswa');
            }
        }

        if ($authService->currentUserGuard() == 'mahasiswa') {
            $sp = Sp::where('id_mhs', $current_user->id_mhs);
        }

        if ($semester) $sp = $sp->where('id_semester', $semester);
        if ($tahun) $sp = $sp->whereHas(
            'mahasiswa', fn ($query) => $query->where('tahun_angkatan', $tahun)
        );

        return $sp->get();
    }

    private function save_sp(Request $request, Sp $sp)
    {
        $sp->id_mhs = $request->id_mhs;
        $sp->id_semester = $request->id_semester;
        $sp->tanggal = $request->tanggal;
        $sp->alfa = $request->alfa;
        if($sp->alfa >= 15 &&  $sp->alfa < 30){
            $sp->status = 'sp1';
            
        } elseif($sp->alfa >= 30 && $sp->alfa < 45) {
            $sp->status = 'sp2';

        } elseif($sp->alfa >= 45) {
            $sp->status = 'sp3';
        }
        $sp->save();

        
        $pdfPath = $this->generate_sp($sp->id_sp);
        $sp->surat = $pdfPath;

        $sp->save();
    }

    private function validate_sp(Request $request)
    {
        $rules = [
            'id_mhs' => 'required|exists:mahasiswas,id_mhs',
            'id_semester' => 'required|exists:semester,id_semester',
            'tanggal' => 'required|date',
            'alfa' => 'required'
        ];
        $messages = [
            'id_mhs.required' => 'Harus memilih mahasiswa',
            'id_semester.required' => 'Harus memilih semester',
            'tanggal.required' => 'Harus mengisi tanggal',
            'alfa.required' => 'Harus mengisi waktu alfa'
        ];

        $request->validate($rules, $messages);
    }

    public function generate_sp($id)
    {
        $sp = Sp::findOrFail($id);
        $pdf = Pdf::loadView('pdf.sp', compact('sp'));
        $pdf = $pdf->setPaper('a4', 'potrait');

        $pdfContent = $pdf->output();

        $pdfPath = 'sp1/'. uniqid() . '.pdf';
        Storage::disk('public')->put($pdfPath, $pdfContent);

        return $pdfPath;
    }
}
