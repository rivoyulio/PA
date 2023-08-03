<?php

namespace App\Http\Services;

use App\Models\Mahasiswa;

class MahasiswaService
{
    public function getMahasiswaById($id_mhs)
    {
        return Mahasiswa::where('id_mhs', $id_mhs)->first();
    }
}
