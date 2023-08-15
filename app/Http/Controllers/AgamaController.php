<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AgamaController extends Controller
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

        return view('admins.agama.index',[
            'agamas' => Agama::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Agama';
        return view('admins.agama.create')->with('title', $title);
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
            'agama'  => 'required',
        ], [
            'agama.required' => 'Agama Harus Diisi',
        ]);

        $data = [
            'agama' => $request->agama,
        ];

        $title = 'Tambah Agama';

        Agama::create($data);
        return redirect('/admin/data/agama')->withSuccessMessage('Agama Berhasil Ditambahkan', compact('title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function show(Agama $agama)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function edit(Agama $agama)
    {
        $data = Agama::where('id_agama', $agama->id_agama)->first();
        return view('admins.agama.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agama $agama)
    {
        $request->validate([
            'agama'  => 'required',
        ], [
            'agama.required' => 'Agama Harus Diisi',
        ]);

        $data = [
            'agama' => $request->agama,
        ];

        $title = 'Edit Agama';

        Agama::where('id_agama', $agama->id_agama)->update($data);
        return redirect('/admin/data/agama')->withSuccessMessage('Data Agama Berhasil Diubah', compact('title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agama $agama)
    {
        $data = Agama::where('id_agama', $agama->id_agama)->first();
        Agama::where('id_agama', $agama->id_agama)->delete();
        return redirect('/admin/data/agama')->withSuccessMessage('Data Agama Berhasil Dihapus');
    }
}
