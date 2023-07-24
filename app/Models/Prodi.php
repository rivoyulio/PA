<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_prodi';

    protected $fillable = [
        'id_user',
        'kode_prodi',
        'nama_prodi',
        'jenjang',
    ];

    public function ketua()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
