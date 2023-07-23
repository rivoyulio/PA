<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Kelas;
use App\Models\Dosen;
use App\Models\Agama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;



class MahasiswaController extends Controller
{
    public function index()
    {
        if(session('success_message')){
            Alert::toast( session('success_message'),'success');
        }

        Mahasiswa::with('prodi','kelas');
        // dd($mahasiswas->get());
        return view('admins.mahasiswa.index',[
            'mahasiswas' => Mahasiswa::all()
        ]);
    }
    
   public function indexmahasiswa()
   {
        // $kelas = Kelas::select('id_kelas');
        // $dosens = Dosen::find($id);
        $mahasiswas = Mahasiswa::get()->where('id_dosen');

        // dd($mahasiswas);
        return view('admins.mahasiswa.datamahasiswa',[
            'mahasiswas' => $mahasiswas,
            // 'dosens' => $dosens,
            // 'kelas' => $kelas
        ]);
   }

   public function indexbiodata()
   {

    return view('admins.mahasiswa.biodata', [
        'mahasiswas' => Mahasiswa::all()
    ]);
    
   }

   public function profile()
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();

        return view('admins.profilemahasiswa.index', [
            'mahasiswa' => $mahasiswa
        ]);
    }


    public function create()
    {   
        $prodis = Prodi::all();
        $kelass = Kelas::all();
        $title = 'Mahasiswa';
        
        return view('admins.mahasiswa.create', compact('kelass', 'prodis', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'nim' => 'numeric',
            'nama_mhs'=> 'required',
            // 'nama_panggilan' => 'required',
            // 'tempat_lahir' => 'required',
            // 'tgl_lahir'=> 'date',
            // 'id_agama' => 'required|numeric',
            // 'jekel' => 'required',
            // 'jmlh_saudara' => 'required|numeric',
            // 'anak_ke' => 'required|numeric',
            // 'no_hp' => 'numeric',
            'id_prodi' => 'required|numeric',
            'password' => 'required',
            'id_kelas' => 'required|numeric',
            'fotomhs' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'provinsi' => 'required',
            // 'kabupaten' => 'required',
            // 'kecamatan' => 'required',
            // 'alamat_mhs' => 'required|numeric',
            // 'nama_sekolah' => 'required|numeric',
            // 'jurusan' => 'required',
            // 'alamat_sekolah' => 'required|numeric',
            // 'prestasi' => 'required|numeric',
            // 'nama_ortu' => 'required',
            // 'alamat_ortu' => 'required|numeric',
            // 'pekerjaan_ortu' => 'required',
            // 'nohp_ortu' => 'numeric',
            // 'nama_wali' => 'required',
            // 'alamat_wali' => 'required|numeric',
            // 'pekerjaan_wali' => 'required',
            // 'nohp_wali' => 'numeric',
            // 'status_biodata' => 'required',
        ], [
            'nim.numeric' => 'Nim Harus Diisi',
            'nama_mhs.required' => 'Nama Harus Diisi',
            // 'nama_panggilan.required' => 'Nama Panggilan Harus Diisi',
            // 'tempat_lahir.required' => 'Tempat Lahir Harus Diisi',
            // 'tgl_lahir.date' => 'Tanggal Lahir Harus Diisi',
            // 'id_agama.required|numeric' => 'Agama Harus Diisi',
            // 'jekel.required' => 'Jenis Kelamin Harus Diisi',
            // 'jmlh_saudara.required|numeric' => 'Jumlah Saudara Harus Diisi',
            // 'anak_ke.required|numeric' => '',
            // 'no_hp.numeric' => 'No Hp Harus Diisi',
            'id_prodi.required|numeric' => '',
            'password.required' => 'Password Harus Diisi',
            'id_kelas.required|numeric' => '',
            'fotomhs.required' => 'Foto User Harus Diisi',
            'fotomhs.image' => 'Foto User Harus Gambar',
            'fotomhs.mimes' => 'Foto User Harus Berformat jpeg,png,jpg,gif,svg',
            'fotomhs.max' => 'Foto User Maksimal 2MB',
            // 'provinsi.required' => 'Nama Provinsi Harus Diisi',
            // 'kabupaten.required' => 'Nama Kabupaten Harus Diisi',
            // 'kecamatan.required' => 'Nama Kecamatan Harus Diisi',
            // 'alamat_mhs.required|numeric' => 'Alamat Harus Diisi',
            // 'nama_sekolah.required|numeric' => 'Nama Sekolah Harus Diisi',
            // 'jurusan.required' => 'Jurusan Harus Diisi',
            // 'alamat_sekolah.required|numeric' => 'Alamat Sekolah Harus Diisi',
            // 'prestasi.required|numeric' => '',
            // 'nama_ortu.required' => 'Nama Orang Tua Harus Diisi',
            // 'alamat_ortu.required|numeric' => 'Alamat Orang Tua Harus Diisi',
            // 'pekerjaan_ortu.required' => 'Pekerjaan Harus Diisi',
            // 'nohp_ortu.numeric' => 'No Hp Orang Tua Harus Diisi',
            // 'nama_wali.required' => '',
            // 'alamat_wali.required|numeric' => '',
            // 'pekerjaan_wali.required' => '',
            // 'nohp_wali.numeric' => '',
            // 'status_biodata.required' => 'Status Biodata Harus Diisi',
        ]);

        $foto_file = $request->file('fotomhs');
        $foto_ekstensi = $foto_file->getClientOriginalExtension();
        $nama_foto = time() . '.' . $foto_ekstensi;
        $foto_file->move(public_path('images'), $nama_foto);

        $data = [
            'nim' => $request->nim,
            'nama_mhs' => $request->nama_mhs,
            // 'nama_panggilan' => $request->nama_panggilan,
            // 'tempat_lahir' => $request->tempat_lahir,
            // 'tgl_lahir' => $request->tgl_lahir,
            // 'id_agama' => $request->id_agama,
            // 'jekel' => $request->jekel,
            // 'jmlh_saudara' => $request->jmlh_saudara,
            // 'anak_ke' => $request->anak_ke,
            // 'no_hp' => $request->no_hp,
            'id_prodi' => $request->id_prodi,
            'password' => Hash::make($request->password),
            'id_kelas' => $request->id_kelas,
            // 'provinsi' => $request->provinsi,
            // 'kabupaten' => $request->kabupaten,
            // 'kecamatan' => $request->kecamatan,
            // 'alamat_mhs' => $request->alamat_mhs,
            // 'nama_sekolah' => $request->nama_sekolah,
            // 'jurusan' => $request->jurusan,
            // 'alamat_sekolah' => $request->alamat_sekolah,
            // 'prestasi' => $request->prestasi,
            // 'nama_ortu' => $request->nama_ortu,
            // 'alamat_ortu' => $request->alamat_ortu,
            // 'pekerjaan_ortu' => $request->pekerjaan_ortu,
            // 'nohp_ortu' => $request->nohp_ortu,
            // 'nama_wali' => $request->nama_wali,
            // 'alamat_wali' => $request->alamat_wali,
            // 'pekerjaan_wali' => $request->pekerjaan_wali,
            // 'nohp_wali' => $request->nohp_wali,
            // 'status_biodata' => $request->status_biodata,
            'fotomhs' => $nama_foto    
        ];

        $title = 'Tambah Mahasiswa';

        Mahasiswa::create($data);
        return redirect()->route('mahasiswa.index')->withSuccessMessage('Data Mahasiswa Berhasil Ditambahkan', compact('title'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswas = $mahasiswa;
        $breadcrum = 'Details Mahasiswa';
        return view('admins.mahasiswa.detailbiodata')->with('mahasiswa', $mahasiswas,compact('breadcrum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {   
        $prodis = Prodi::all();
        $kelass = Kelas::all();
        $data = Mahasiswa::where('id_mhs', $mahasiswa->id_mhs)->first();
        return view('admins.mahasiswa.edit', compact('kelass', 'prodis', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'numeric',
            'nama_mhs'=> 'required',
            // 'nama_panggilan' => 'required',
            // 'tempat_lahir' => 'required',
            // 'tgl_lahir'=> 'date',
            // 'id_agama' => 'required|numeric',
            // 'jekel' => 'required',
            // 'jmlh_saudara' => 'required|numeric',
            // 'anak_ke' => 'required|numeric',
            // 'no_hp' => 'numeric',
            'id_prodi' => 'required|numeric',
            'password' => 'required',
            'id_kelas' => 'required|numeric',
            'fotomhs' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'provinsi' => 'required',
            // 'kabupaten' => 'required',
            // 'kecamatan' => 'required',
            // 'alamat_mhs' => 'required|numeric',
            // 'nama_sekolah' => 'required|numeric',
            // 'jurusan' => 'required',
            // 'alamat_sekolah' => 'required|numeric',
            // 'prestasi' => 'required|numeric',
            // 'nama_ortu' => 'required',
            // 'alamat_ortu' => 'required|numeric',
            // 'pekerjaan_ortu' => 'required',
            // 'nohp_ortu' => 'numeric',
            // 'nama_wali' => 'required',
            // 'alamat_wali' => 'required|numeric',
            // 'pekerjaan_wali' => 'required',
            // 'nohp_wali' => 'numeric',
            // 'status_biodata' => 'required',
        ], [
            'nim.numeric' => 'Nim Harus Diisi',
            'nama_mhs.required' => 'Nama Harus Diisi',
            // 'nama_panggilan.required' => 'Nama Panggilan Harus Diisi',
            // 'tempat_lahir.required' => 'Tempat Lahir Harus Diisi',
            // 'tgl_lahir.date' => 'Tanggal Lahir Harus Diisi',
            // 'id_agama.required|numeric' => 'Agama Harus Diisi',
            // 'jekel.required' => 'Jenis Kelamin Harus Diisi',
            // 'jmlh_saudara.required|numeric' => 'Jumlah Saudara Harus Diisi',
            // 'anak_ke.required|numeric' => '',
            // 'no_hp.numeric' => 'No Hp Harus Diisi',
            'id_prodi.required|numeric' => '',
            'password.required' => 'Password Harus Diisi',
            'id_kelas.required|numeric' => '',
            'fotomhs.required' => 'Foto User Harus Diisi',
            'fotomhs.image' => 'Foto User Harus Gambar',
            'fotomhs.mimes' => 'Foto User Harus Berformat jpeg,png,jpg,gif,svg',
            'fotomhs.max' => 'Foto User Maksimal 2MB',
            // 'provinsi.required' => 'Nama Provinsi Harus Diisi',
            // 'kabupaten.required' => 'Nama Kabupaten Harus Diisi',
            // 'kecamatan.required' => 'Nama Kecamatan Harus Diisi',
            // 'alamat_mhs.required|numeric' => 'Alamat Harus Diisi',
            // 'nama_sekolah.required|numeric' => 'Nama Sekolah Harus Diisi',
            // 'jurusan.required' => 'Jurusan Harus Diisi',
            // 'alamat_sekolah.required|numeric' => 'Alamat Sekolah Harus Diisi',
            // 'prestasi.required|numeric' => '',
            // 'nama_ortu.required' => 'Nama Orang Tua Harus Diisi',
            // 'alamat_ortu.required|numeric' => 'Alamat Orang Tua Harus Diisi',
            // 'pekerjaan_ortu.required' => 'Pekerjaan Harus Diisi',
            // 'nohp_ortu.numeric' => 'No Hp Orang Tua Harus Diisi',
            // 'nama_wali.required' => '',
            // 'alamat_wali.required|numeric' => '',
            // 'pekerjaan_wali.required' => '',
            // 'nohp_wali.numeric' => '',
            // 'status_biodata.required' => 'Status Biodata Harus Diisi',
        ]);

        $data = [
            'nim' => $request->nim,
            'nama_mhs' => $request->nama_mhs,
            // 'nama_panggilan' => $request->nama_panggilan,
            // 'tempat_lahir' => $request->tempat_lahir,
            // 'tgl_lahir' => $request->tgl_lahir,
            // 'id_agama' => $request->id_agama,
            // 'jekel' => $request->jekel,
            // 'jmlh_saudara' => $request->jmlh_saudara,
            // 'anak_ke' => $request->anak_ke,
            // 'no_hp' => $request->no_hp,
            'id_prodi' => $request->id_prodi,
            'password' => Hash::make($request->password),
            'id_kelas' => $request->id_kelas,
            // 'provinsi' => $request->provinsi,
            // 'kabupaten' => $request->kabupaten,
            // 'kecamatan' => $request->kecamatan,
            // 'alamat_mhs' => $request->alamat_mhs,
            // 'nama_sekolah' => $request->nama_sekolah,
            // 'jurusan' => $request->jurusan,
            // 'alamat_sekolah' => $request->alamat_sekolah,
            // 'prestasi' => $request->prestasi,
            // 'nama_ortu' => $request->nama_ortu,
            // 'alamat_ortu' => $request->alamat_ortu,
            // 'pekerjaan_ortu' => $request->pekerjaan_ortu,
            // 'nohp_ortu' => $request->nohp_ortu,
            // 'nama_wali' => $request->nama_wali,
            // 'alamat_wali' => $request->alamat_wali,
            // 'pekerjaan_wali' => $request->pekerjaan_wali,
            // 'nohp_wali' => $request->nohp_wali,
            // 'status_biodata' => $request->status_biodata,  

        ];

        if ($request->hasFile('fotomhs')) {
            $foto_file = $request->file('fotomhs');
            $foto_ekstensi = $foto_file->getClientOriginalExtension();
            $nama_foto = time() . '.' . $foto_ekstensi;
            $foto_file->move(public_path('images'), $nama_foto);
            $data_foto = Mahasiswa::where('id_mhs', $mahasiswa->id_mhs)->first();
            File::delete(public_path('images/' . $data_foto->fotomhs));
        }

        $data['fotomhs'] = $nama_foto;
        $title = 'Edit Mahasiswa';


        Mahasiswa::where('id_mhs', $mahasiswa->id_mhs)->update($data);
        return redirect()->route('mahasiswa.index')->withSuccessMessage('Data Mahasiswa Berhasil Diubah', compact('title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $data = Mahasiswa::where('id_mhs', $mahasiswa->id_mhs)->first();
        File::delete(public_path('images/' . $data->fotomhs));
        Mahasiswa::where('id_mhs', $mahasiswa->id_mhs)->delete();
        return redirect()->route('mahasiswa.index')->withSuccessMessage('Mahasiswa Berhasil Dihapus');
    }
}
