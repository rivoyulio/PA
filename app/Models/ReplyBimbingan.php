<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyBimbingan extends Model
{
    use HasFactory;

    protected $table = 'detail_bimbingans';

    protected $fillable = [
        'id_bimbingan',
        'message',
        'id_mhs',
        'id_dsn',
        'status'
    ];

    public function bimbingan()
    {
        return $this->belongsTo(Bimbingan::class, 'id_bimbingan');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mhs');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dsn');
    }
}
