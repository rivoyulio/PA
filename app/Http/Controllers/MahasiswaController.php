<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Kelas;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class MahasiswaController extends Controller
{
    public function index()
    {
        return view('admins.mahasiswa.index',['mahasiswas' => Mahasiswa::all()]);
    }

    public function indexmahasiswa(AuthService $authService)
    {
         $user = $authService->currentUserGuardInstance()->user();
         $dosen = Dosen::where('id_user', $user->id_user)->first();

         $mahasiswas = Mahasiswa::whereHas(
             'kelas', fn ($query) => $query->where('id_dosen', $dosen->id_dosen)
         )->get();

         return view('admins.mahasiswa.datamahasiswa', compact('mahasiswas'));
    }

    public function indexbiodata(AuthService $authService)
    {
         $user = $authService->currentUserGuardInstance()->user();
         $dosen = Dosen::where('id_user', $user->id_user)->first();

         $mahasiswas = Mahasiswa::whereHas(
             'kelas', fn ($query) => $query->where('id_dosen', $dosen->id_dosen)
         )->get();

         return view('admins.mahasiswa.biodata', compact('mahasiswas'));
    }

    public function profile(AuthService $authService)
    {
        return view('admins.profilemahasiswa.index', ['mahasiswa' => $authService->currentUserGuardInstance()->user()]);
    }

   public function create()
   {
       $prodis = Prodi::all();
       $kelass = Kelas::all();
       $title = 'Mahasiswa';

       return view('admins.mahasiswa.create', compact('kelass', 'prodis'));
   }

    public function store(Request $request, AuthService $authService)
    {
        $this->validate_mahasiswa($request);
        $this->save_mahasiswa($request, new Mahasiswa());

        return $this->redirect_to_index($authService, 'Data Mahasiswa Berhasil Ditambahkan');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('admins.mahasiswa.detailbiodata')->with('mahasiswa', $mahasiswa);
    }

    public function edit(Mahasiswa $data)
    {
        $prodis = Prodi::all();
        $kelass = Kelas::all();

        return view('admins.mahasiswa.edit', compact('kelass', 'prodis', 'data'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa, AuthService $authService)
    {
        $this->validate_mahasiswa($request, true);
        $this->save_mahasiswa($request, $mahasiswa);

        return $this->redirect_to_index($authService, 'Data Mahasiswa Berhasil Diubah');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        if ($mahasiswa->foto_mhs) {
            unlink(public_path('images/' . $mahasiswa->foto_mhs));
        }

        return redirect('/admin/data/mahasiswa')->withSuccessMessage('Mahasiswa Berhasil Dihapus');
    }

    private function validate_mahasiswa(Request $request, $is_edit = false)
    {
        $rules = [
            'nim' => 'numeric',
            'nama_mhs'=> 'required',
            'id_prodi' => 'required|numeric',
            'id_kelas' => 'required|numeric',
            'fotomhs' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required',
        ];

        if ($is_edit) {
            $rules = [
                'nama_mhs' => 'required',
                'nama_panggilan' => 'required',
                'id_agama' => 'required|numeric',
                'tahun_angkatan' => 'required|numeric',
                'password' => 'nullable',
                'tempat_lahir' => 'required',
                'tgl_lahir' => 'required|date',
                'jekel' => 'required',
                'no_hp' => 'required',
                'anak_ke' => 'required|numeric',
                'jmlh_saudara' => 'required|numeric',
            ];
        }

        $request->validate($rules);
    }

    public function save_mahasiswa(Request $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa->nama_mhs = $request->nama_mhs;
        $mahasiswa->nama_panggilan = $request->nama_panggilan;
        $mahasiswa->id_agama = $request->id_agama;
        $mahasiswa->tahun_angkatan = $request->tahun_angkatan;
        $mahasiswa->tempat_lahir = $request->tempat_lahir;
        $mahasiswa->tgl_lahir = $request->tgl_lahir;
        $mahasiswa->jekel = $request->jekel;
        $mahasiswa->no_hp = $request->no_hp;
        $mahasiswa->anak_ke = $request->anak_ke;
        $mahasiswa->jmlh_saudara = $request->jmlh_saudara;
        $mahasiswa->id_prodi = $request->id_prodi;
        $mahasiswa->id_kelas = $request->id_kelas;

        if ($request->password) {
            $mahasiswa->password = Hash::make($request->password);
        }

        if ($request->hasFile('fotomhs')) {
            if ($mahasiswa->fotomhs) {
                unlink(public_path('images/' . $mahasiswa->fotomhs));
            }

            $fotomhs = $request->file('fotomhs');
            $fotomhs_name = time() . '_' . $fotomhs->getClientOriginalName();
            $fotomhs->move(public_path('images'), $fotomhs_name);

            $mahasiswa->fotomhs = $fotomhs_name;
        }

        $mahasiswa->save();
    }

    public function redirect_to_index(AuthService $authService, $message)
    {
        if ($authService->currentUserIsAdmin()) {
            return redirect('/admin/data/mahasiswa')->withSuccess($message);
        }

        return redirect('/mahasiswa')->withSuccess($message);
    }
}
