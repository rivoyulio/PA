<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_bimbingan';

    protected $fillable = [
        'id_mhs',
        'tanggal_bimbingan',
        'topic',
        'bimbingan',
        'pesan_mhs',
        'pesan_dosen',
        'file'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mhs', 'id_mhs');
    }

    public function reply()
    {
        return $this->hasMany(ReplyBimbingan::class, 'id_bimbingan');
    }
}
