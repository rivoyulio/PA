<?php

namespace App\Http\Services;

use App\Models\Bimbingan;

class BimbinganService
{
    public function getBimbinganMahasiswa($mahasiswa_id)
    {
        return Bimbingan::with(['reply'])->whereHas('mahasiswa', fn ($query) => $query->where('id_mhs', $mahasiswa_id))->get();
    }

    public function getBimbinganDosen()
    {
        return Bimbingan::with('mahasiswa');
    }
}
