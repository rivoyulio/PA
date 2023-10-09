<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriPelanggaranRequest;
use App\Models\PelanggaranCategory;
use Illuminate\Http\Request;

class KategoriPelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = PelanggaranCategory::all();
        return view('admins.pelanggaran.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.pelanggaran.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategoriPelanggaranRequest $request)
    {
        $data = $request->all();

        PelanggaranCategory::create($data);

        return redirect()->route('kategori.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = PelanggaranCategory::findOrFail($id);
        return view('admins.pelanggaran.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KategoriPelanggaranRequest $request, string $id)
    {
        $data = $request->all();

        $kategori_update = PelanggaranCategory::findOrFail($id);
        $kategori_update->update($data);

        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = PelanggaranCategory::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index');
    }
}
