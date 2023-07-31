<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pelanggaran';

    protected $fillable = [
        'id_pelanggaran',
        'id_sp',
        'id_mhs',
    ];

    public function sp()
    {
        return $this->belongsTo(Sp::class, 'id_sp', 'id_sp');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mhs', 'id_mhs');
    }
}
