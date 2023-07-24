<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Pelanggaran;
use App\Models\Sp;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function index()
    {
        $user_or_msh = false;
        if ($user = auth()->guard('web')->user()) $user_or_msh = 'user';
        else if ($user = auth()->guard('mahasiswa')->user()) $user_or_msh = 'msh';

        if ($user_or_msh == 'user') {
            if ($user->level == 'admin') $pelanggaran = Pelanggaran::query();

            if ($user->level == 'dosen') {
                $pelanggaran = Pelanggaran::whereHas('mahasiswa.kelas.dosen', fn ($query) => $query->where('id_user', $user->id_user));
            }

            if ($user->level == 'kaprodi') {
                $pelanggaran = Pelanggaran::whereHas('mahasiswa.kelas.prodi', fn ($query) => $query->where('id_user', $user->id_user));
            }
        }

        if ($user_or_msh === 'msh') {
            $pelanggaran = Pelanggaran::where('id_mhs', $user->id_mhs);
        }

        return view('admins.pelanggaran.index', ['pelanggaran' => $pelanggaran->paginate(10)]);
    }

    public function create()
    {
        return view('admins.pelanggaran.create', $this->load_relation());
    }

    public function store(Request $request)
    {
        $this->validate_pelanggaran($request);
        Pelanggaran::create(
            [
                'id_sp' => $request->id_sp,
                'id_mhs' => $request->id_mhs,
            ]
        );

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
        $pelanggaran->update(
            [
                'id_sp' => $request->id_sp,
                'id_mhs' => $request->id_mhs,
            ]
        );

        return redirect('/pelanggaran')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(Pelanggaran $pelanggaran)
    {
        $pelanggaran->delete();
        return redirect('/pelanggaran')->with('success', 'Data berhasil dihapus!');
    }

    protected function load_relation()
    {
        $sps = Sp::all();
        $mahasiswas = Mahasiswa::all();

        return compact('sps', 'mahasiswas');
    }

    protected function validate_pelanggaran(Request $request)
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
