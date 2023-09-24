<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $table = 'semester';

    protected $primaryKey = 'id_semester';

    protected $fillable = [
        'name'
    ];

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class, 'id_pelanggaran');
    }
}
