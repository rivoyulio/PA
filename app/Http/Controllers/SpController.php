<?php

namespace App\Http\Controllers;

use App\Models\Sp;
use Illuminate\Http\Request;

class SpController extends Controller
{
    public function index()
    {
        return view('admins.sp.index', ['sps' => Sp::paginate(5)]);
    }

    public function create()
    {
        return view('admins.sp.create');
    }

    public function store(Request $request)
    {
        $this->validate_sp($request);
        Sp::create(
            [
                'nama_sp' => $request->sp_name
            ]
        );

        return redirect('/sp')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Sp $sp)
    {
        return view('admins.sp.edit', compact('sp'));
    }

    public function update(Request $request, Sp $sp)
    {
        $this->validate_sp($request);
        $sp->update(
            [
                'nama_sp' => $request->sp_name
            ]
        );

        return redirect('/sp')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(Sp $sp)
    {
        $sp->delete();
        return redirect('/sp')->with('success', 'Data berhasil dihapus!');
    }

    protected function validate_sp(Request $request)
    {
        $rules = ['sp_name' => 'required'];
        $messages = ['sp_name.required' => 'Nama SP harus diisi'];

        $request->validate($rules, $messages);
    }
}
