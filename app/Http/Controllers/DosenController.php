<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        return view('admins.dosen.index', ['dosens' => Dosen::all()]);
    }

    public function biodatadosen(AuthService $authService)
    {
        $user = $authService->currentUserGuardInstance()->user();
        $dosen = Dosen::where('id_user', $user->id_user)->first();
        // dd($dosen);
        return view('admins.dosen.biodatadosen', compact('dosen'));
    }

    public function create()
    {
        $users = User::all();
        $title = 'Dosen';

        return view('admins.dosen.create', compact('users', 'title'));
    }

    public function store(Request $request, AuthService $authService)
    {
        $this->validate_dosen($request);
        $this->save_dosen($request, new Dosen());

        return $this->redirect_to_index($authService, 'Data Dosen Berhasil Ditambahkan');
    }

    public function show(Dosen $dosens)
    {
        return view('admins.dosen.details', compact('dosens'));
    }

    public function edit(Dosen $dosen)
    {
        return view('admins.dosen.edit')->with('data', $dosen);
    }

    public function update(Request $request, Dosen $dosen, AuthService $authService)
    {
        $this->validate_dosen($request, true);
        $this->save_dosen($request, $dosen);

        return $this->redirect_to_index($authService, 'Data dosen Berhasil Diubah');
    }

    public function destroy(Dosen $dosen, AuthService $authService)
    {
        $dosen->delete();

        return $this->redirect_to_index($authService, 'Data Dosen Berhasil Dihapus');
    }

    private function validate_dosen(Request $request, $is_edit = false)
    {
        $rules = [
            'id_user' => 'required|numeric',
            'nip' => 'numeric',
            'nama_dosen'  => 'required',
            'jabatan'  => 'required',
            'tempat_lahir'  => 'required',
            'tgl_lahir'  => 'date',
            'alamat' => 'required',
            'notelp'  => 'numeric',
        ];

        if ($is_edit) {
            $rules = [
                'nama_dosen'  => 'required',
                'tempat_lahir'  => 'required',
                'tgl_lahir'  => 'date',
                'alamat' => 'required',
                'notelp'  => 'numeric',
            ];
        }

        $messages = [
            'id_user' => '',
            'nip.numeric' => 'NIP Harus Diisi',
            'nama_dosen.required' => 'Nama Dosen Harus Diisi',
            'jabatan.required' => 'Jabatan Dosen Harus Diisi',
            'tempat_lahir.required' => 'Tempat Lahir Dosen Harus Diisi',
            'tgl_lahir.date' => 'Tanggal Lahir Dosen Harus Diisi',
            'alamat.required' => 'Alamat Dosen Harus Diisi',
            'notelp.numeric' => 'No Telepon Dosen Harus Diisi',
        ];

        $request->validate($rules, $messages);
    }

    private function save_dosen(Request $request, Dosen $dosen)
    {
        $dosen->id_user ??= $request->id_user;
        $dosen->nip ??= $request->nip;
        $dosen->nama_dosen = $request->nama_dosen;
        $dosen->jabatan ??= $request->jabatan;
        $dosen->tempat_lahir = $request->tempat_lahir;
        $dosen->tgl_lahir = $request->tgl_lahir;
        $dosen->alamat = $request->alamat;
        $dosen->notelp = $request->notelp;
        $dosen->save();
    }

    private function redirect_to_index(AuthService $authService, $message)
    {
        if ($authService->currentUserIsAdmin()) {
            return redirect('/admin/data/dosen')->withSuccess($message);
        }

        return redirect('/dosen')->withSuccess($message);
    }
}
