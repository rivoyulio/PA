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
        'deskripsi',
        'id_komdis',
        'id_kategori'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mhs', 'id_mhs');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester');
    }

    public function komdis()
    {
        return $this->belongsTo(komdis::class, 'id_komdis');
    }

    public function kategori()
    {
        return $this->belongsTo(PelanggaranCategory::class, 'id_kategori');
    }
}
