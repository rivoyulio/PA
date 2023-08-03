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
            'kelass' => $kelass->paginate(5)
        ]);
    }

    public function kelasdetail($id)
    {
        $kelas = Kelas::find($id);
        $mahasiswas = Mahasiswa::all()->where('id_kelas', $id);
        // dd($mahasiswa);
        return view('admins.kelas.kelasdetail',[
            'kelas' => $kelas,
            'mahasiswas' => $mahasiswas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        return redirect()->route('/admin/data/kelas')->withSuccessMessage('Data Kelas Berhasil Ditambahkan', compact('title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        $kelas = $kelas;
        $breadcrum = 'Details kelas';
        return view('admins.kelas.details')->with('kelas', $kelas,compact('breadcrum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas, $id)
    {
        $prodis = Prodi::all();
        $dosens = Dosen::all();

        $data = Kelas::find($id);
        return view('admins.kelas.edit', compact('dosens', 'prodis', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
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
        return redirect()->route('/admin/data/kelas')->withSuccessMessage('Data Kelas Berhasil Diubah', compact('title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        $data = Kelas::where('id_kelas', $kelas->id_kelas)->first();
        Kelas::where('id_kelas', $kelas->id_kelas)->delete();
        return redirect()->route('/admin/data/kelas')->withSuccessMessage('Data Kelas Berhasil Dihapus');
    }

    public function delete(Mahasiswa $mahasiswa)
    {
        $data = Mahasiswa::where('id_mhs', $mahasiswa->id_mhs)->first();
        Mahasiswa::where('id_mhs', $mahasiswa->id_mhs)->delete();
        return redirect()->route('mahasiswa.index')->withSuccessMessage('Mahasiswa Berhasil Dihapus');
    }
}
