<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
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

        return view('admins.dosen.index',[
            'dosens' => Dosen::paginate(5)
        ]);
    }

    public function biodatadosen()
    {
        $user = Auth::user();
        $dosen = $user->dosen;
// dd($user);
        return view('admins.dosen.biodatadosen', [
            'dosen' => $dosen
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $title = 'Dosen';
        return view('admins.dosen.create', compact('users', 'title'));
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
            'id_user' => 'required|numeric',
            'nip' => 'numeric',
            'nama_dosen'  => 'required',
            'jabatan'  => 'required',
            'tempat_lahir'  => 'required',
            'tgl_lahir'  => 'date',
            'alamat' => 'required',
            'notelp'  => 'numeric',
        ], [
            'id_user' => '',
            'nip.numeric' => 'NIP Harus Diisi',
            'nama_dosen.required' => 'Nama Dosen Harus Diisi',
            'jabatan.required' => 'Jabatan Dosen Harus Diisi',
            'tempat_lahir.required' => 'Tempat Lahir Dosen Harus Diisi',
            'tgl_lahir.date' => 'Tanggal Lahir Dosen Harus Diisi',
            'alamat.required' => 'Alamat Dosen Harus Diisi',
            'notelp.numeric' => 'No Telepon Dosen Harus Diisi',

        ]);

        $data = [
            'id_user' => $request->id_user,
            'nip' => $request->nip,
            'nama_dosen' => $request->nama_dosen,
            'jabatan' => $request->jabatan,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'notelp' => $request->notelp,
        ];

        $title = 'Tambah Dosen';

        Dosen::create($data);
        return redirect()->route('/admin/data/dosen')->withSuccessMessage('Data Dosen Berhasil Ditambahkan', compact('title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        $dosens = $dosen;
        $breadcrum = 'Details Dosen';
        return view('admins.dosen.details')->with('dosen', $dosens,compact('breadcrum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        $data = Dosen::where('id_dosen', $dosen->id_dosen)->first();
        return view('admins.dosen.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'id_user' => 'required|numeric',
            'nip' => 'numeric',
            'nama_dosen'  => 'required',
            'jabatan'  => 'required',
            'tempat_lahir'  => 'required',
            'tgl_lahir'  => 'date',
            'alamat' => 'required',
            'notelp'  => 'numeric',
        ], [
            'id_user' => '',
            'nip.numeric' => 'NIP Harus Diisi',
            'nama_dosen.required' => 'Nama Dosen Harus Diisi',
            'jabatan.required' => 'Jabatan Dosen Harus Diisi',
            'tempat_lahir.required' => 'Tempat Lahir Dosen Harus Diisi',
            'tgl_lahir.date' => 'Tanggal Lahir Dosen Harus Diisi',
            'alamat.required' => 'Alamat Dosen Harus Diisi',
            'notelp.numeric' => 'No Telepom Dosen Harus Diisi',

        ]);

        $data = [
            'id_user' => $request->id_user,
            'nip' => $request->nip,
            'nama_dosen' => $request->nama_dosen,
            'jabatan' => $request->jabatan,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'notelp' => $request->notelp,
        ];

        $title = 'Edit Dosen';

        Dosen::where('id_dosen', $dosen->id_dosen)->update($data);
        return redirect()->route('/admin/data/dosen')->withSuccessMessage('Data dosen Berhasil Diubah', compact('title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        $data = Dosen::where('id_dosen', $dosen->id_dosen)->first();
        // File::delete(public_path('images/' . $data->foto_brg));
        Dosen::where('id_dosen', $dosen->id_dosen)->delete();
        return redirect()->route('/admin/data/dosen')->withSuccessMessage('Data Dosen Berhasil Dihapus');
    }
}
