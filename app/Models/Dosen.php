<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_dosen';

    protected $fillable = [
        'id_user',
        'nip',
        'nama_dosen',
        'jabatan',
        'tempat_lahir',
        'tgl_lahir',
        'alamat',
        'notelp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
      
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'id_dosen');
    }

}
