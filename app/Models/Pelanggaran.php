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
        'id_mhs',
        'tanggal',
        'id_semester',
        'waktu_keterlambatan',
        'surat'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mhs', 'id_mhs');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester');
    }
}
