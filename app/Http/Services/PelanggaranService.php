<?php

namespace App\Http\Services;

use App\Models\Pelanggaran;

class PelanggaranService {
    public function getPelanggaranByMhs($id_msh)
    {
        return Pelanggaran::where('id_mhs', $id_msh)->get();
    }
}
