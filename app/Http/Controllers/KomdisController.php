<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Models\Dosen;
use App\Models\komdis;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class KomdisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AuthService $authService)
    {

        if(session('success_message')){
            Alert::toast( session('success_message'),'success');
        }
        
        // if ($authService->currentUserGuard() == 'web') {
        //     if($authService->currentUserIsDosen()){
        //         $komdis = komdis::where('id_dosen', $current_user->id_user)->get();
        //     }

        //     else {
        //         $komdis = komdis::all();
        //     }
        // }

        $komdis = komdis::all();

        return view('admins.komdis.index',[
            'komdiss' => $komdis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosen = Dosen::all();
        // dd($dosen);
        return view('admins.komdis.create', compact('dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'id_dosen'  => 'required|exists:dosens,id_dosen',

        ];

        $message = [
            'id_dosen.required' => 'Harus memilih dosen',

        ];

        $request->validate($rules, $message);

        $data = $request->all();
        // dd($data);
        Komdis::create($data);
        return redirect('/admin/data/komdis')->with('success','Data Komdis Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(komdis $komdis, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $komdis = komdis::with('dosen')->findOrFail($id);
        // dd($komdis);
        $dosen = Dosen::all();
        return view('admins.komdis.edit', compact('komdis', 'dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'id_dosen'  => 'required|exists:dosens,id_dosen',

        ];

        $message = [
            'id_dosen.required' => 'Harus memilih dosen',

        ];

        $request->validate($rules, $message);

        $data = $request->all();

        $title = 'Edit Komdis';

        $komdis = Komdis::findOrFail($id);
        $komdis->update($data);

        return redirect('/admin/data/komdis')->with('success', 'Data Komdis Berhasil Di Edit', compact('title'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komdis $komdis, $id)
    {
        $data = komdis::findOrFail($id);
        $data->delete();
        return redirect('/admin/data/komdis')->with('success','Data komdis Berhasil Dihapus');
    }
}
