<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komdis extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_komdis';

    protected $fillable = [
        'id_dosen'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class, 'id_komdis');
    }

}
