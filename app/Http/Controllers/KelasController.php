<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session('success_message')){
            Alert::toast( session('success_message'),'success');
        }

        $kelass = Kelas::with('prodi','dosen');

        return view('admins.kelas.index',[
            'kelass' => $kelass->get()
        ]);
    }

    public function kelasdetail($id)
    {
        $kelas = Kelas::find($id);
        $mahasiswas = Mahasiswa::all()->where('id_kelas', $id);
        return view('admins.kelas.kelasdetail',[
            'kelas' => $kelas,
            'mahasiswas' => $mahasiswas
        ]);
    }

    public function create()
    {
        $dosens = Dosen::all();
        $prodis = Prodi::all();
        $title = 'Kelas';

        return view('admins.kelas.create', compact('dosens', 'prodis', 'title'));
    }

    public function kelascreate()
    {
        $dosens = Dosen::all();
        $prodis = Prodi::all();
        $title = 'Kelas';

        return view('admins.kelas.kelascreate', compact('dosens', 'prodis', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'id_prodi' => 'required',
            'id_dosen' => 'required',
            'tahun_angkatan' => 'required',
            'jumlah' => 'required',
        ], [
            'nama_kelas.required' => 'Nama Kelas Harus Diisi',
            'id_prodi.required' => '',
            'id_dosen.required' => '',
            'tahun_angkatan.required' => 'Tahun Angkatan Harus Diisi',
            'jumlah.required' => 'Jumlah Mahasiswa Harus Diisi',
        ]);

        $data = [
            'nama_kelas' => $request->nama_kelas,
            'id_prodi' => $request->id_prodi,
            'id_dosen' => $request->id_dosen,
            'tahun_angkatan' => $request->tahun_angkatan,
            'jumlah' => $request->jumlah,
        ];

        $title = 'Tambah Kelas';

        Kelas::create($data);
        return redirect('/admin/data/kelas')->withSuccessMessage('Data Kelas Berhasil Ditambahkan', compact('title'));
    }

    public function show($id)
    {
        return view('admins.kelas.kelasdetail', ['kelas' => Kelas::find($id)]);
    }

    public function edit(Kelas $kelas, $id)
    {
        $prodis = Prodi::all();
        $dosens = Dosen::all();

        $data = Kelas::find($id);
        return view('admins.kelas.edit', compact('dosens', 'prodis', 'data'));
    }

    public function update(Request $request, Kelas $kelas, $id)
    {

        $request->validate([
            'nama_kelas' => 'required',
            'id_prodi' => 'required',
            'id_dosen' => 'required',
            'tahun_angkatan' => 'required',
            'jumlah' => 'required',
        ], [
            'nama_kelas.required' => 'Nama Kelas Harus Diisi',
            'id_prodi.required' => '',
            'id_dosen.required' => '',
            'tahun_angkatan.required' => 'Tahun Angkatan Harus Diisi',
            'jumlah.required' => 'Jumlah Mahasiswa Harus Diisi',
        ]);

        $data = [
            'nama_kelas' => $request->nama_kelas,
            'id_prodi' => $request->id_prodi,
            'id_dosen' => $request->id_dosen,
            'tahun_angkatan' => $request->tahun_angkatan,
            'jumlah' => $request->jumlah,
        ];

        // dd($data);
        $title = 'Edit Kelas';

        Kelas::find($id)->update($data);
        return redirect('/admin/data/kelas')->withSuccessMessage('Data Kelas Berhasil Diubah', compact('title'));
    }

    public function destroy($id)
    {
        Kelas::where('id_kelas', $id)->delete();
        return redirect('/admin/data/kelas')->withSuccessMessage('Data Kelas Berhasil Dihapus');
    }

    public function delete(Mahasiswa $mahasiswa)
    {
        $data = Mahasiswa::where('id_mhs', $mahasiswa->id_mhs)->first();
        Mahasiswa::where('id_mhs', $mahasiswa->id_mhs)->delete();
        return redirect()->route('mahasiswa.index')->withSuccessMessage('Mahasiswa Berhasil Dihapus');
    }
}
