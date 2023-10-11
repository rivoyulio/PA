<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelanggaranCategory extends Model
{
    use HasFactory;

    protected $table = 'kategori_pelanggaran';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class, 'id_pelanggaran');
    }
}
