<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProdiController extends Controller
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
        
        return view('admins.prodi.index',[
            'prodis' => Prodi::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Prodi';
        return view('admins.prodi.create')->with('title', $title);
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
            'kode_prodi'  => 'required',
            'nama_prodi'  => 'required',
            'jenjang'  => 'required',
        ], [
            'kode_prodi.required' => '',
            'nama_prodi.required' => '',
            'jenjang.required' => '',
        ]);

        $data = [
            'kode_prodi' => $request->kode_prodi,
            'nama_prodi' => $request->nama_prodi,
            'jenjang' => $request->jenjang,
        ];

        $title = 'Tambah Prodi';

        Prodi::create($data);
        return redirect()->route('prodi.index')->withSuccessMessage('Data Prodi Berhasil Ditambahkan', compact('title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function show(Prodi $prodi)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function edit(Prodi $prodi)
    {
        $data = Prodi::where('id_prodi', $prodi->id_prodi)->first();
        return view('admins.prodi.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'kode_prodi'  => 'required',
            'nama_prodi'  => 'required',
            'jenjang'  => 'required',
        ], [
            'kode_prodi.required' => '',
            'nama_prodi.required' => '',
            'jenjang.required' => '',
        ]);

        $data = [
            'kode_prodi' => $request->kode_prodi,
            'nama_prodi' => $request->nama_prodi,
            'jenjang' => $request->jenjang,
        ];


        $title = 'Edit Prodi';

        Prodi::where('id_prodi', $prodi->id_prodi)->update($data);
        return redirect()->route('prodi.index')->withSuccessMessage('Data Prodi Berhasil Diubah', compact('title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prodi $prodi)
    {
        $data = Prodi::where('id_prodi', $prodi->id_prodi)->first();
        Prodi::where('id_prodi', $prodi->id_prodi)->delete();
        return redirect()->route('prodi.index')->withSuccessMessage('Data Prodi Berhasil Dihapus');
    }
}
