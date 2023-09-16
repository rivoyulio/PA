<?php

namespace App\Http\Controllers;

use App\Models\komdis;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class KomdisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(session('success_message')){
            Alert::toast( session('success_message'),'success');
        }

        return view('admins.komdis.index',[
            'komdiss' => Komdis::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_komdis' => 'required',
            'kode_komdis'  => 'required',
        ], [
            'id_komdis' => '',
            'nama_komdis.required' => '',
        ]);

        $data = [
            'id_komdis' => $request->id_komdis,
            'nama_komdis' => $request->nama_komdis,
        ];

        $title = 'Tambah Komdis';

        Komdis::create($data);
        return redirect('/admin/data/komdis')->withSuccessMessage('Data Komdis Berhasil Ditambahkan', compact('title'));
    }

    /**
     * Display the specified resource.
     */
    public function show(komdis $komdis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Komdis $komdis)
    {
        $request->validate([
            'id_komdis' => 'required',
            'kode_komdis'  => 'required',
        ], [
            'id_komdis' => '',
            'nama_komdis.required' => '',
        ]);

        $data = [
            'id_komdis' => $request->id_komdis,
            'nama_komdis' => $request->nama_komdis,
        ];

        $title = 'Edit Komdis';

        Komdis::where('id_komdis', $komdis->id_komdis)->update($data);
        return redirect('/admin/data/komdis')->withSuccessMessage('Data Komdis Berhasil Di Edit', compact('title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, komdis $komdis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komdis $komdis)
    {
        $data = Komdis::where('id_komdis', $komdis->id_komdis)->first();
        Komdis::where('id_komdis', $komdis->id_komdis)->delete();
        return redirect('/admin/data/komdis')->withSuccessMessage('Data komdis Berhasil Dihapus');
    }
}
